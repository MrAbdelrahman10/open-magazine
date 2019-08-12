<?php

$_['_Active'] = 'Active';
$_['_Add'] = 'New';
$_['_AddCopy'] = 'Add Copy';
$_['_AdminSettings'] = 'Admin Settings';
$_['_Alias'] = 'Alias';
$_['_Author'] = 'Author';
$_['_Back'] = 'Back';
$_['_BrowseSite'] = 'Browse Site';
$_['_Cancel'] = 'Cancel';
$_['_Choose'] = 'Choose';
$_['_ConfirmDelete'] = 'Are you sure you want to delete? ... It will be deleted all related data on selected elements';
$_['_Contents'] = 'Contents';
$_['_ControlPanel'] = 'Dashboard';
$_['_Copyright'] = 'Developed By <a href="http://mrabdelrahman10.com" >MrAbdelrahman10</a>';
$_['_CreatedDate'] = 'Created Date';
$_['_Delete'] = 'Delete';
$_['_Description'] = 'Description';
$_['_DeSelectAll'] = 'DeSelect All';
$_['_Details'] = 'Details';
$_['_Direction'] = 'ltr';
$_['_Disable'] = 'Disable';
$_['_Edit'] = 'Update';
$_['_Email'] = 'Email';
$_['_Enable'] = 'Enable';
$_['_Error'] = 'Error!';
$_['_Example'] = 'Example';
$_['_Featured'] = 'Featured';
$_['_FileManager'] = 'File Manager';
$_['_HPSO'] = 'Sorting in Home Page';
$_['_ID'] = 'ID';
$_['_InActive'] = 'InActive';
$_['_Keywords'] = 'Keywords';
$_['_Lang'] = 'en';
$_['_Message'] = 'Message!';
$_['_ModifiedDate'] = 'Last Modified Date';
$_['_Multimedia'] = 'Multimedia';
$_['_NotFound'] = ' --- No --- ';
$_['_No'] = 'No';
$_['_PageNotFound'] = 'Page is not Found';
$_['_ParentCategory'] = 'Parent Category';
$_['_Password'] = 'Password';
$_['_Picture'] = 'Picture';
$_['_PictureOptions'] = 'Picture Options';
$_['_Preview'] = 'Preview';
$_['_Publish'] = 'Publish';
$_['_PublishOptions'] = 'Publish Options';
$_['_Save'] = 'Save';
$_['_SavedDone'] = 'Saved Done.';
$_['_ScheduleArticle'] = 'Schedule Article';
$_['_Search'] = 'Search';
$_['_SelectAll'] = 'Select All';
$_['_SelectAll_None'] = 'DeSellect All';
$_['_SeoOptions'] = 'SEO Options';
$_['_Settings'] = 'Settings';
$_['_SignIn'] = 'Sign In';
$_['_SignOut'] = 'Sign Out';
$_['_SiteSettings'] = 'Site Settings';
$_['_SortingOrder'] = 'Sorting Order';
$_['_State'] = 'Status';
$_['_Title'] = 'Title';
$_['_Reset'] = 'Reset';
$_['_View'] = 'Display {1}';
$_['_Viewed'] = 'Viewes';
$_['_Unexpected_Error'] = 'There are An Unexpected Error occurred .. Try Again.';
$_['_UnPublish'] = 'Un Publish';
$_['_User'] = 'User';
$_['_UserName'] = 'User Name';
$_['_Users'] = 'Users';
$_['_Waiting'] = 'Loading ...';
$_['_Warning'] = 'Warning!';
$_['_Warning_Message'] = 'There are some Errors, See Input Data.';
$_['_Yes'] = 'Yes';

//Menu

$_['_Article'] = 'Article';
$_['_Articles'] = 'Articles';
$_['_Articles_Add'] = 'Add New Article';
$_['_Articles_View'] = 'Display Articles';

$_['_Article_tmp'] = 'Schedule Article';
$_['_Articles_tmp'] = 'Schedule Articles';
$_['_Articles_tmp_Add'] = 'Add New Schedule Article';
$_['_Articles_tmp_View'] = 'Display Schedule Articles';

$_['_Banner'] = 'Banner';
$_['_Banners'] = 'Banners';
$_['_Banners_Add'] = 'Add New Banner';
$_['_Banners_View'] = 'View Banners';

$_['_Categories'] = 'Categories';
$_['_Categories_Add'] = 'Add New Categories';
$_['_Categories_View'] = 'Display Categories';
$_['_Category'] = 'Category';

$_['_Comic'] = 'Comic';
$_['_Comics'] = 'Comics';
$_['_Comics_Add'] = 'Add New Comic';
$_['_Comics_View'] = 'Display Comics';

$_['_Comments'] = 'Comments';
$_['_Comments_View'] = 'Display Comments';

$_['_DayPicture'] = 'Picture Day';
$_['_DayPictures'] = 'Pictures Day';
$_['_DayPictures_Add'] = 'Add New Picture Day';
$_['_DayPictures_View'] = 'Display Picture Day';

$_['_Menus'] = 'Menus';
$_['_Menus_Add'] = 'Add New Menu Item';
$_['_Menus_View'] = 'Display Menu Items';

$_['_Page'] = 'Page';
$_['_Pages'] = 'Pages';
$_['_Pages_Add'] = 'Add New Page';
$_['_Pages_View'] = 'Display Pages';

$_['_Paper_Archive'] = ' Paper Archive';
$_['_Paper_Archives'] = ' Papers Archives';
$_['_Paper_Archives_Add'] = 'Add New Paper Archive';
$_['_Paper_Archives_View'] = 'Display Paper Archive';

$_['_Photos'] = 'Pictures';
$_['_Gallery'] = 'Gallery';
$_['_Galleries'] = 'Galleries';
$_['_Galleries_Add'] = 'Add New Gallery';
$_['_Galleries_View'] = 'Display Gallery';

$_['_Poll'] = 'Poll';
$_['_Polls'] = 'Polls';
$_['_Polls_Add'] = 'Add New Poll';
$_['_Polls_View'] = 'Display Pollss';

$_['_User'] = 'User';
$_['_Users'] = 'Users';
$_['_Users_Add'] = 'Add New User';
$_['_Users_View'] = 'Display Users';

$_['_Video'] = 'Video';
$_['_Videos'] = 'Videos';
$_['_Videos_Add'] = 'Add New Video';
$_['_Videos_View'] = 'Display Videos';


// MenuItemTypes
$_['_MenuItemTypes'] = array(
    array(// row #0
        'ID' => 1,
        'Alias' => 'List_All_Categories',
        'Title' => 'Display All Categories',
        'Description' => NULL,
        'Format' => 'news/cats',
        'Editable' => 0,
        'TableData' => NULL,
    ),
    array(// row #1
        'ID' => 2,
        'Alias' => 'List_Contents_Category',
        'Title' => 'Display All Child Categories For an Category',
        'Description' => NULL,
        'Format' => 'news/tc/{0}',
        'Editable' => 0,
        'TableData' => 'Categories',
    ),
    array(// row #2
        'ID' => 3,
        'Alias' => 'Single_Article',
        'Title' => 'Display Article',
        'Description' => NULL,
        'Format' => 'news/i/{0}',
        'Editable' => 0,
        'TableData' => 'Posts',
    ),
    array(// row #3
        'ID' => 4,
        'Alias' => 'List_All_in_Category',
        'Title' => 'Display Articles for Selected Category',
        'Description' => NULL,
        'Format' => 'news/c/{0}',
        'Editable' => 0,
        'TableData' => 'Categories',
    ),
    array(// row #4
        'ID' => 5,
        'Alias' => 'External_Link',
        'Title' => 'External Link',
        'Description' => NULL,
        'Format' => '{0}',
        'Editable' => 1,
        'TableData' => NULL,
    ),
    array(// row #5
        'ID' => 6,
        'Alias' => 'Break',
        'Title' => 'Separator',
        'Description' => NULL,
        'Format' => 'javascript:void(0)',
        'Editable' => 0,
        'TableData' => NULL,
    ),
    array(// row #6
        'ID' => 7,
        'Alias' => 'Code',
        'Title' => 'Code',
        'Description' => NULL,
        'Format' => '{0}',
        'Editable' => 1,
        'TableData' => NULL,
    ),
    array(// row #7
        'ID' => 8,
        'Alias' => 'Page',
        'Title' => 'Display Page',
        'Description' => NULL,
        'Format' => 'page/i/{0}',
        'Editable' => 0,
        'TableData' => 'Pages',
    ),
    array(// row #8
        'ID' => 9,
        'Alias' => 'PhotoAlbum',
        'Title' => 'Display Gallery',
        'Description' => NULL,
        'Format' => 'gallery/i/{0}',
        'Editable' => 0,
        'TableData' => 'MenuAlbums',
    ),
    array(// row #9
        'ID' => 10,
        'Alias' => 'Videos',
        'Title' => 'Display Videos',
        'Description' => NULL,
        'Format' => 'video',
        'Editable' => 0,
        'TableData' => NULL,
    ),
    array(// row #10
        'ID' => 11,
        'Alias' => 'Home',
        'Title' => 'Home',
        'Description' => NULL,
        'Format' => 'home',
        'Editable' => 0,
        'TableData' => NULL,
    ),
);
