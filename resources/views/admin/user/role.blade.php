@extends('layouts.common')
@section('style')
@endsection
@section('content')
<div class="site-demo">
    <div class="layui-tab-content" id="adduser" style="padding: 20px;">
        <section class="panel panel-padding">
            <form class="layui-form" id="userrolereset">
                <input type="hidden" name="id" id="userId" value="{{ $id }}">
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/user.user_role')!!}</label>
                    <div class="layui-input-inline">
                        <select name="role" lay-filter="roleselect">
                            @foreach ($list as $item)
                            <option value="{{ $item['id'] }}" <?php echo isset($role['id']) && $item['id'] == $role['id'] ? 'selected' : '';?>>{{ $item['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection
@section('my-js')
<script src="{{ asset('back/js/user/user-save.js') }}"></script>
@endsection
