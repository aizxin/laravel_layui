<?php
namespace Aizxin\Presenters;
use Aizxin\Services\Admin\PermissionService;
class MenuPresenter
{
	/**
     * 权限仓库实现.
     *
     * @var PermissionRepository
     */
    protected $menu;

    /**
     * 创建一个新的属性composer.
     *
     * @param PermissionRepository $menu
     * @return void
     */
    public function __construct(PermissionService $menu)
    {
        $this->menu = $menu;
    }
	/**
	 *  [topMenuList 添加修改菜单关系select]
	 *  chouchong.com
	 *  @author Sow
	 *  @DateTime 2017-04-16T23:42:18+0800
	 *  @param    [type]                   $menus [description]
	 *  @param    string                   $pid   [description]
	 *  @return   [type]                          [description]
	 */
	public function topMenuList($menus,$pid = '')
	{
		$html = '<option value="0">'.trans('admin/menu.topMenu').'</option>';
		if ($menus) {
			foreach ($menus as $v) {
				$html .= '<option value="'.$v['id'].'" '.$this->checkMenu($v['id'],$pid).'>'.$v['name'].'</option>';
				foreach ($v['child'] as $vv) {
					$html .= '<option value="'.$vv['id'].'" '.$this->checkMenu($vv['id'],$pid).'>  ├  '.$vv['name'].'</option>';
				}
			}
		}
		return $html;
	}
	/**
	 *  [checkMenu 判断是否选中]
	 *  chouchong.com
	 *  @author Sow
	 *  @DateTime 2017-04-16T23:41:57+0800
	 *  @param    [type]                   $menuId [description]
	 *  @param    [type]                   $pid    [description]
	 *  @return   [type]                           [description]
	 */
	public function checkMenu($menuId,$pid)
	{
		if ($pid !== '') {
			if ($menuId == $pid) {
				return 'selected="selected"';
			}
			return '';
		}
		return '';
	}
	/**
	 *  [topMenuName 获取菜单关系名称]
	 *  chouchong.com
	 *  @author Sow
	 *  @DateTime 2017-04-16T23:41:47+0800
	 *  @param    [type]                   $menus [description]
	 *  @param    [type]                   $pid   [description]
	 *  @return   [type]                          [description]
	 */
	public function topMenuName($menus,$pid)
	{
		if ($pid == 0) {
			return '顶级菜单';
		}
		if ($menus) {
			foreach ($menus as $v) {
				if ($v['id'] == $pid) {
					return $v['name'];
				}
			}
		}
		return '';
	}
	/**
	 *  [childMenu 多级菜单显示]
	 *  chouchong.com
	 *  @author Sow
	 *  @DateTime 2017-04-16T23:41:40+0800
	 *  @param    [type]                   $childMenu [description]
	 *  @return   [type]                              [description]
	 */
	public function childMenu($childMenu)
	{
		$html = '';
		if ($childMenu) {
			foreach ($childMenu as $v) {
				$icon = $v['icon'] ? '<i class="'.$v['icon'].'"></i>':'';
				$html .= '<li class="'.active_class(if_uri_pattern(explode(',',$v['active'])),'active').'"><a href="'.url($v['url']).'">'.$icon.$v['name'].'</a></li>';
			}
		}
		return $html;
	}
	// <li class="layui-nav-item layui-nav-itemed">
	// 	<a class="javascript:;" href="javascript:;">基本元素</a>
	// 	<dl class="layui-nav-child">
	// 	    <dd class="layui-this">
	// 	        <a href="/user">按钮组</a>
	// 	    </dd>
	// 	    <dd class="">
	// 	        <a href="/demo/form.html">表单集合</a>
	// 	    </dd>
	// 	    <dd class="">
	// 	        <a href="/demo/nav.html">导航与面包屑</a>
	// 	    </dd>
	// 	    <dd class="">
	// 	        <a href="/demo/tab.html">选项卡</a>
	// 	    </dd>
	// 	    <dd class="">
	// 	        <a href="/demo/progress.html">进度条</a>
	// 	    </dd>
	// 	    <dd class="">
	// 	        <a href="/demo/collapse.html">折叠面板</a>
	// 	    </dd>
	// 	    <dd class="">
	// 	        <a href="/demo/table.html">基本表格</a>
	// 	    </dd>
	// 	    <dd class="">
	// 	        <a href="/demo/auxiliar.html">简单辅助元素</a>
	// 	    </dd>
	// 	</dl>
	// </li>
	/**
	 *  [sidebarMenus 左侧菜单渲染]
	 *  chouchong.com
	 *  @author Sow
	 *  @DateTime 2017-04-16T23:44:03+0800
	 *  @param    [type]                   $menus [description]
	 *  @return   [type]                          [description]
	 */
	public function sidebarMenus($menus)
	{
		$rule = $this->menu->getMenuId(\Route::currentRouteName());
		$parent = array();
		if($rule){
			if($rule['zMenu']['parent_id'] > 0){
				$parent = $rule['fMenu'];
			}
			$child = $rule['zMenu'];
		}
		$html = '';
		$active = '';
		if ($menus) {
			foreach ($menus as $v) {
				if (auth()->user()->hasPermission($v['slug'])) {
					$active = '';
					if($rule){
						if($v['id'] == $child['parent_id'] || $parent['parent_id'] == $v['id']){
							$active = 'layui-nav-itemed';
						}else{
							$active = '';
						}
					}
					$html .= '<li class="layui-nav-item '.$active.'">';
					if ($v['child']) {
						$html .= '<a class="javascript:;" href="javascript:;">';
						$html .= '<i class="'.$v['icon'].'" style="position: relative; top: 3px;"></i>';
						$html .= '<cite>'.$v['name'].'</cite>';
					    $html .= '</a>';
					    if($rule){
						    $html .= $this->getSidebarChildMenu($v['child'],$child,$parent,$rule);
						}else {
							$html .= $this->getSidebarChildMenu($v['child'],[],[],$rule);
						}
					}
					$html .= '</li>';
				}
			}
		}
		return $html;
	}
	/**
	 *  [getSidebarChildMenu 左侧菜单子菜单渲染]
	 *  chouchong.com
	 *  @author Sow
	 *  @DateTime 2017-04-16T23:43:49+0800
	 *  @param    string                   $childMenu [description]
	 *  @param    [type]                   $child     [description]
	 *  @param    array                    $parent    [description]
	 *  @return   [type]                              [description]
	 */
	public function getSidebarChildMenu($childMenu='',$child,$parent = array(),$rule)
	{
		$html = '';
		$active = '';
		if ($childMenu) {
			$html .= '<dl class="layui-nav-child">';
			foreach ($childMenu as $v) {
				if (auth()->user()->hasPermission($v['slug'])) {
					$active = '';
					if($rule){
						if($v['id'] == $child['id'] || $child['parent_id'] == $v['id']){
							$active = 'layui-this';
						}else{
							$active = '';
						}
					}
					$html .= '<dd class="'.$active.'">';
					$html .= '<a href="'.\URL::route($v['slug']).'">';
					$html .= '<i class="'.$v['icon'].'" style="position: relative; top: 3px;"></i>';
					$html .= '<cite>'.$v['name'].'</cite>';
				    $html .= '</a></dd>';
				}
			}
			$html .= '</dl>';
		}
		return $html;
	}

}