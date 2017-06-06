<div style="display: none" id="useraddhtml">
    <section class="panel panel-padding">
        <form class="layui-form" action="">
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/user.model.username')!!}</label>
                <div class="layui-input-inline">
                    <input type="text" name="username" lay-verify="required|username" autocomplete="off" placeholder="{!!trans('admin/user.placeholder.username')!!}" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/user.model.name')!!}</label>
                <div class="layui-input-inline">
                    <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="{!!trans('admin/user.placeholder.name')!!}" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/user.model.password')!!}</label>
                <div class="layui-input-inline">
                    <input type="text" name="password" lay-verify="required|pass" autocomplete="off" placeholder="{!!trans('admin/user.placeholder.password')!!}" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="useradd">{!!trans('admin/setting.save')!!}</button>
                    <button type="reset" class="layui-btn layui-btn-primary">{!!trans('admin/setting.reset')!!}</button>
                </div>
            </div>
        </form>
    </section>
</div>
