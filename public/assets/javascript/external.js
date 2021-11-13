const changeLanguage = (language = 'az') => $.get('/change-language/'+language, { }, () => location.reload());
const addChoosedList = (objectId) => {
    if()
    $.get('/choosed/'+objectId, { }, () => { });
}
const addCompareList = (objectId) => {
    $.get('/compare/'+objectId, { }, ( ) => { });
}
