<?php
/**
 *  管理员
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IconController extends Controller
{
    /**
     *  [index 图标列表]
     *  chouchong.com
     *  @author Sow
     *  @DateTime 2017-04-08T02:16:45+0800
     *  @return   [type]                   [description]
     */
    public function index()
    {
        return view('admin.icon.index');
    }
}
