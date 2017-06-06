<div style="display: none" id="useredithtml">
    <section class="panel panel-padding">
        <form class="layui-form" id="usereditreset">
            <div class="layui-form-item">
            <input type="hidden" name="id" value="@{{euser.id}}">
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/user.model.name')!!}</label>
                <div class="layui-input-inline">
                    <input type="text" name="username" lay-verify="required" autocomplete="off" placeholder="{!!trans('admin/user.placeholder.username')!!}" value="@{{euser.username}}" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/user.model.name')!!}</label>
                <div class="layui-input-inline">
                    <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="{!!trans('admin/user.placeholder.name')!!}" value="@{{euser.name}}" class="layui-input">
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
                    <button class="layui-btn" lay-submit="" lay-filter="useredit">{!!trans('admin/setting.resave')!!}</button>
                </div>
            </div>
        </form>
    </section>
</div>
