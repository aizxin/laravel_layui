<div class="container-fluid larry-wrapper" id="addpermissionhtml">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <section class="panel panel-padding">
                <form class="layui-form">
                    <div class="layui-form-item">
                        <label class="layui-form-label">上级权限</label>
                        <div class="layui-input-inline">
                            <select name="modules" lay-verify="required" lay-search="">
                                <option value="">直接选择或搜索选择</option>
                                <option value="1">layer</option>
                                <option value="2">form</option>
                                <option value="3">layim</option>
                                <option value="4">element</option>
                                <option value="5">laytpl</option>
                                <option value="6">upload</option>
                                <option value="7">laydate</option>
                                <option value="8">laypage</option>
                                <option value="9">flow</option>
                                <option value="10">util</option>
                                <option value="11">code</option>
                                <option value="12">tree</option>
                                <option value="13">layedit</option>
                                <option value="14">nav</option>
                                <option value="15">tab</option>
                                <option value="16">table</option>
                                <option value="17">select</option>
                                <option value="18">checkbox</option>
                                <option value="19">switch</option>
                                <option value="20">radio</option>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">权限名称</label>
                        <div class="layui-input-inline">
                            <input type="text" name="name" lay-verify="name" autocomplete="off" placeholder="请输入权限名称" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">权限别名</label>
                        <div class="layui-input-inline">
                            <input type="text" name="slug" lay-verify="required" placeholder="请输入权限别名" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">是否菜单</label>
                        <div class="layui-input-block">
                            <input name="ismenu" lay-skin="switch" lay-filter="switchTest" lay-text="否|是" type="checkbox">
                        </div>
                    </div>
                    <div class="layui-form-item">
                          <label class="layui-form-label">权限图标</label>
                          <div class="layui-input-block">
                            <input type="text" name="icon" placeholder="请输入图标" autocomplete="off" class="layui-input-inline layui-input">
                            <span class='layui-btn layui-btn-primary' style='padding:0 12px;min-width:45.2px'>
                                <i id='icon-preview' style='font-size:1.2em' class=''></i>
                            </span>
                            <button type='button' data-icon='icon' class='layui-btn layui-btn-primary'>选择图标</button>
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">权限描述</label>
                        <div class="layui-input-block">
                            <textarea placeholder="权限描述" name="description" class="layui-textarea"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
