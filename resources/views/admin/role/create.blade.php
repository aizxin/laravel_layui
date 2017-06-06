<div id="roleaddhtml" style="display: none">
    <section class="panel panel-padding">
        <form class="layui-form">
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/role.model.name')!!}</label>
                <div class="layui-input-inline">
                    <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="{!!trans('admin/role.placeholder.name')!!}" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/role.model.slug')!!}</label>
                <div class="layui-input-inline">
                    <input type="text" name="slug" lay-verify="required" placeholder="{!!trans('admin/role.placeholder.slug')!!}" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">{!!trans('admin/role.model.description')!!}</label>
                <div class="layui-input-block">
                    <textarea placeholder="{!!trans('admin/role.placeholder.description')!!}" name="description" class="layui-textarea" lay-verify="required" style="width: 190px;"></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="roleadd">{!!trans('admin/setting.save')!!}</button>
                    <button type="reset" class="layui-btn layui-btn-primary">{!!trans('admin/setting.reset')!!}</button>
                </div>
            </div>
        </form>
    </section>
</div>