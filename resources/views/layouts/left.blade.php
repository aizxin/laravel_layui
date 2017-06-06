<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">

        <ul class="layui-nav layui-nav-tree site-demo-nav">
            @inject('menu','Aizxin\Presenters\MenuPresenter')
            {!! $menu->sidebarMenus($slidebar) !!}
            <!-- <li class="layui-nav-item layui-nav-itemed">
                <a class="javascript:;" href="javascript:;">开发工具</a>
                <dl class="layui-nav-child">
                    <dd>
                        <a href="/user">调试预览</a>
                    </dd>
                </dl>
            </li>

            <li class="layui-nav-item layui-nav-itemed">
                <a class="javascript:;" href="javascript:;">组件示例</a>
                <dl class="layui-nav-child">
                    <dd class="">
                        <a href="/demo/layer.html">
                            <i class="layui-icon" style="top: 3px;">&#xe638;</i><cite>弹出层</cite>
                        </a>
                    </dd>
                    <dd class="">
                        <a href="/demo/layim.html">
                            <i class="layui-icon" style="position: relative; top: 3px;">&#xe63a;</i>
                            <cite>即时通讯</cite>
                        </a>
                    </dd>
                    <dd class="">
                        <a href="/demo/laydate.html">
                            <i class="layui-icon" style="top: 1px;">&#xe637;</i><cite>日期时间选择</cite>
                        </a>
                    </dd>
                    <dd class="">
                        <a href="/demo/laypage.html">
                            <i class="layui-icon">&#xe633;</i><cite>多功能分页</cite>
                        </a>
                    </dd>
                    <dd class="">
                        <a href="/demo/laytpl.html">
                            <i class="layui-icon">&#xe628;</i><cite>模板引擎</cite>
                        </a>
                    </dd>
                    <dd class="">
                        <a href="/demo/layedit.html">
                            <i class="layui-icon">&#xe639;</i>
                            <cite>富文本编辑器</cite>
                        </a>
                    </dd>
                    <dd class="">
                        <a href="/demo/upload.html">
                            <i class="layui-icon">&#xe62f;</i>
                            <cite>文件上传</cite>
                        </a>
                    </dd>
                    <dd class="">
                        <a href="/demo/tree.html">
                            <i class="layui-icon">&#xe62e;</i>
                            <cite>树形菜单</cite>
                        </a>
                    </dd>
                    <dd class="">
                        <a href="/demo/util.html">
                            <i class="layui-icon">&#xe631;</i>
                            <cite>工具块</cite>
                        </a>
                    </dd>
                    <dd class="">
                        <a href="/demo/flow.html">
                            <i class="layui-icon">&#xe636;</i>
                            <cite>流加载</cite>
                        </a>
                    </dd>
                    <dd class="">
                        <a href="/demo/code.html">
                            <i class="layui-icon" style="top: 1px;">&#xe635;</i>
                            <cite>代码修饰器</cite>
                        </a>
                    </dd>
                </dl>
            </li> -->
            <li class="layui-nav-item" style="height: 30px; text-align: center"></li>
        </ul>

    </div>
</div>