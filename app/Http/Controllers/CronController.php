<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use ArrayObject;

class CronController extends Controller
{
    public function index()
    {
        die('I am working');
    }

    public function promote()
    {
        $announcements = Announcement::where('data.remainingPromotionCount', '>', 0)->get();

        foreach ($announcements as $announcement) {
            $this->promoteAnnouncement($announcement);
        }

        die('I am promoted');
    }

    public function promoteAnnouncement($announcement)
    {
        $announcementData = (new ArrayObject($announcement['data']))->getArrayCopy();
        $announcementData['remainingPromotionCount'] = $announcementData['remainingPromotionCount'] - 1;
        $announcementData['orderDate'] = date("c");
        $announcement['data'] = $announcement;
        $announcement->save();

        echo $announcement['_id'] . ' promoted;';

    }
}
