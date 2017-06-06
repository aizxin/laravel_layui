<div id="roleedithtml" class="layui-form" style="display: none">
    <section class="panel panel-padding">
        <form class="layui-form" id="roleeditreset">
            <div class="layui-form-item">
                <input type="hidden" name="id" value="@{{elrole.id}}">
                <label class="layui-form-label">{!!trans('admin/role.model.name')!!}</label>
                <div class="layui-input-inline">
                    <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="{!!trans('admin/role.placeholder.name')!!}" class="layui-input" value="@{{elrole.name}}">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/role.model.slug')!!}</label>
                <div class="layui-input-inline">
                    <input type="text" name="slug" lay-verify="required" placeholder="{!!trans('admin/role.placeholder.slug')!!}" autocomplete="off" class="layui-input" value="@{{elrole.slug}}">
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">{!!trans('admin/role.model.description')!!}</label>
                <div class="layui-input-block">
                    <textarea placeholder="{!!trans('admin/role.placeholder.description')!!}" name="description" class="layui-textarea" lay-verify="required" style="width: 190px;">@{{elrole.description}}</textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="roleedit">{!!trans('admin/setting.resave')!!}</button>
                </div>
            </div>
        </form>
    </section>
</div>