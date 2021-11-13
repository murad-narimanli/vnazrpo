<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use ArrayObject;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{

    public function index()
    {
        return redirect(langUrlPrefix() . '/profile/announcements');
    }

    public function announcements($type = "ACTIVE")
    {
        if (!Auth::user()) {
            return redirect('/');
        }

        $types = [
            'ACTIVE',
            'PENDING',
            'EXPIRED',
            'REJECTED'
        ];
        $user = User::find(Auth::user()->id);

        $announcements = Announcement::where('data.user', Auth::user()->id)->where('data.status', $type)->paginate(15);
        if (!in_array($type, $types))
            abort(404);

        $announcementsCount = Announcement::where('data.user', Auth::user()->id)->get();
        $activeCount = $this->countAnnouncement($announcementsCount, 'ACTIVE');
        $pendingCount = $this->countAnnouncement($announcementsCount, 'PENDING');
        $expiredCount = $this->countAnnouncement($announcementsCount, 'EXPIRED');
        $rejectedCount = $this->countAnnouncement($announcementsCount, 'REJECTED');

        $userBalance = isset($user['data']['balance']) ? $user['data']['balance'] / 100 : 0;

        $data = [
            'announcements' => $announcements,
            'userBalance' => $userBalance,
            'user' => $user,
            'activeTab' => 'announcements',
            'activeCount' => $activeCount,
            'pendingCount' => $pendingCount,
            'expiredCount' => $expiredCount,
            'rejectedCount' => $rejectedCount,
        ];
        return view('profile/announcements', $data);
    }

    public function countAnnouncement($items, $status): int
    {
        $count = 0;

        foreach ($items as $item) {
            if ($item['data']['status'] === $status) {
                $count++;
            }
        }

        return $count;
    }

    public function balance()
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $user = User::find(Auth::user()->id);

        $announcements = Announcement::where('data.user', Auth::user()->id)->get();

        $userBalance = isset($user['data']['balance']) ? $user['data']['balance'] / 100 : 0;
        $payedOrderCount = 0;

        foreach ($announcements as $announcement) {
            if (isset($announcement['data']['is-vip']) || (isset($announcement['data']['remainingPromotionCount']) && $announcement['data']['remainingPromotionCount'] > 0)) {
                $payedOrderCount++;
            }
        }

        $freeOrderCount = count($announcements) - $payedOrderCount;

        $data = [
            'userBalance' => $userBalance,
            'payedOrderCount' => $payedOrderCount,
            'freeOrderCount' => $freeOrderCount,
            'user' => $user,
            'activeTab' => 'balance'
        ];
        return view('profile/balance', $data);
    }

    public function payments()
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $user = User::find(Auth::user()->id);

        $payments = Payment::where('data.userId', Auth::user()->id)->get();

        $data = [
            'payments' => $payments,
            'user' => $user,
            'activeTab' => 'payments'
        ];
        return view('profile/payments', $data);
    }

    public function orders()
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $user = User::find(Auth::user()->id);

        $orders = Order::where('data.user', Auth::user()->id)->get();

        $data = [
            'orders' => $orders,
            'user' => $user,
            'activeTab' => 'orders'
        ];
        return view('profile/orders', $data);
    }

    public function profile()
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $user = User::find(Auth::user()->id);

        $data = [
            'user' => $user,
            'activeTab' => 'profile'
        ];
        return view('profile/profile', $data);
    }

    public function addOrder(Request $request)
    {
        if (!Auth::user()) {
            return redirect('/');
        }

        $announcementId = $request->input('announcementId');
        $amount = $request->input('amount');
        $type = $request->input('type');

        $user = User::find(Auth::user()->id);
        $announcement = Announcement::find($announcementId);

        $balance = $user['data']['balance'] ?? 0;

        if ($amount < 0) {
            return response()->json(json_encode([
                'status' => 'error',
                'message' => 'wrong balance'
            ]), 400);
        }

        $this->checkTariffs($type, $amount);

        if ($balance < $amount) {
            return response()->json(json_encode([
                'status' => 'error',
                'message' => 'insufficient balance'
            ]), 400);
        }

        if ($type === 'vip' && isset($announcement['data']['is-vip']) && $announcement['data']['is-vip']) {
            return response()->json(json_encode([
                'status' => 'exists',
                'message' => 'already is vip'
            ]), 400);
        }

        $announcementData = (new ArrayObject($announcement['data']))->getArrayCopy();

        if ($type === 'vip') {
            $announcementData['is-vip'] = true;
        } else if ($type === 'promote') {
            $announcementData['remainingPromotionCount'] = 3;
        } else {
            throw new \Exception();
        }

        $announcement['data'] = $announcementData;
        $announcement->save();

        $order = new Order();
        $order['data'] = [
            'user' => $user['_id'],
            'announcement' => $announcementId,
            'amount' => $amount,
            'type' => $type,
        ];
        $order['publishDate'] = time();

        $order->save();

        $this->decreaseUserBalance($user, $amount);
    }

    private function decreaseUserBalance($user, $amount)
    {
        $data = (new ArrayObject($user['data']))->getArrayCopy();

        $data['balance'] -= $amount;

        $user['data'] = $data;

        $user->save();
    }

    private function checkTariffs($type, $amount)
    {

    }

    public function addBalance(Request $request)
    {
        if (!Auth::user()) {
            return redirect('/');
        }

        $payload = [
            'userId' => Auth::user()->id,
            'price' => (int)($request->input('price') * 100)
        ];

        $token = 'eyJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MjU0MDE1MDEsImV4cCI6MjYyNTQxMTUwMSwidXNlclJvbGUiOiJBRE1JTiIsInVzZXJFbWFpbCI6ImFkbWluQGFkbWluLmNvbSIsInVzZXJJZCI6IjYwY2RmMGVkNjI3MTlmNWNhNDc3NjIxOCIsInRva2VuVHlwZSI6ImFjY2VzcyJ9.RfpeUJ2yXhvu8TOCNjh_exCnONsXOSWEBbeQkhATT5U';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json'
        ])->post('http://evinaznew.cms.kube.tisserv.net/api/payments', $payload);
        // echo '<pre>';print_r($response->json());die();
        if ($response->ok() && (isset($response->json()['data']['payUrl']) && !empty($response->json()['data']['payUrl']))) {
            echo json_encode([
                'status' => 200,
                'redirectUrl' => $response->json()['data']['payUrl']
            ]);
        } else {
            echo json_encode([
                'status' => 500,
                'response' => $response,
                'payload' => $payload,
            ]);
        }
        die();
    }

    public function editProfileDetail(Request $request)
    {
        if (!Auth::user()) {
            return redirect('/');
        }

        if ($request->method() != 'POST')
            return false;

        // echo Auth::user()->id;die();
        User::where('_id', Auth::user()->id)->update(['data.' . $request->input('data')['type'] => $request->input('data')['value']]);
        // $user->data[$request->input('data')['type']] = $request->input('data')['value'];

        // $user->save();
        // Auth::update($request->input('data'))
        // User::where('_id',Auth::user())
        // ->update($updData);

        echo json_encode(['status' => 200]);
    }
}
