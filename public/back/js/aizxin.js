/**
 @Name：layui.sow 工具集
 @Author：Sow
 @License：MIT
*/

layui.define(['jquery', 'layer'], function(exports) {
    "use strict";
    var $ = layui.jquery,
        layer = layui.layer;
    var sow = sow || {};
    sow.parse_url = function(url) {
        var parse = url.match(/^(?:([a-z]+):\/\/)?([\w-]+(?:\.[\w-]+)+)?(?::(\d+))?([\w-\/]+)?(?:\?((?:\w+=[^#&=\/]*)?(?:&\w+=[^#&=\/]*)*))?(?:#([\w-]+))?$/i);
        parse || $.error("url格式不正确！");
        return {
            "scheme": parse[1],
            "host": parse[2],
            "port": parse[3],
            "path": parse[4],
            "query": parse[5],
            "fragment": parse[6]
        };
    }
    sow.parse_str = function(str) {
        var value = str.split("&"),
            vars = {},
            param;
        for (var i = 0; i < value.length; i++) {
            param = value[i].split("=");
            vars[param[0]] = param[1];
        }
        return vars;
    }
    sow.U = function(url, vars) {
        if (!url || url == '') return '';
        var info = this.parse_url(url),
            path = [],
            reg;
        /* 验证info */
        info.path || $.error("url格式错误！");
        url = info.path;
        /* 解析URL */
        path = url.split("/");
        // path = [path.pop(), path.pop(), path.pop()].reverse();
        // path[1] || $.error("sow.U(" + url + ")没有指定控制器");

        /* 解析参数 */
        if (typeof vars === "string") {
            vars = sow.parse_str(vars);
        }
        /* 解析URL自带的参数 */
        info.query && $.extend(vars, this.parse_str(info.query));
        // if (false !== sow.conf.SUFFIX) {
        //  url += "." + sow.conf.SUFFIX;
        // }
        if ($.isPlainObject(vars)) {
            url += "?" + $.param(vars);
        }
        //url = url.replace(new RegExp("%2F","gm"),"+");
        url = window.conf.APP + "/" + url;
        return url;
    };
    /**
     *  [load 加载。。。]
     *  @author Sow
     *  @DateTime 2017-06-11T14:41:34+0800
     *  @return   {[type]}                 [description]
     */
    sow.load = function(index) {
            return layer.load(index, {
                shade: 0.5
            });
        }
        /**
         *  [msgE 错误]
         *  @author Sow
         *  @DateTime 2017-06-11T14:42:51+0800
         *  @param    {[type]}                 index [description]
         *  @return   {[type]}                       [description]
         */
    sow.msgE = function(message) {
            return layer.msg(message, {
                icon: 5,
                shift: 1,
                shade: 0.5
            });
        }
        /**
         *  [msgS 成功]
         *  @author Sow
         *  @DateTime 2017-06-11T14:45:52+0800
         *  @param    {[type]}                 message [description]
         *  @param    {Function}               fn      [description]
         *  @return   {[type]}                         [description]
         */
    sow.msgS = function(message, fn) {
            return layer.msg(message, {
                icon: 6,
                shade: 0.5,
                shift: 1,
                time: 1000
            }, fn);
        }
        /**
         *  [open description]
         *  @author Sow
         *  @DateTime 2017-06-11T23:15:25+0800
         *  @param    {[type]}                 lang [description]
         *  @param    {[type]}                 url  [description]
         *  @return   {[type]}                      [description]
         */
    sow.open = function(lang, url, area) {
            var indexLoad = layer.load(1);
            layer.open({
                type: 2, //1:test//2:url
                title: lang,
                shade: 0.3,
                full: false,
                shadeClose: true,
                maxmin: true, //开启最大化最小化按钮
                area: area,
                anim: 1, // 动作方向
                content: url,
                success: function(layero, index) {
                    layer.close(indexLoad);
                }
            });
        }
        /**
         *  [confirm description]
         *  @author Sow
         *  @DateTime 2017-06-12T22:00:07+0800
         *  @param    {[type]}                 lang  [description]
         *  @param    {[type]}                 title [description]
         *  @param    {Function}               fn    [description]
         *  @return   {[type]}                       [description]
         */
    sow.confirm = function(lang, title, fn) {
        layer.confirm(lang, {
            icon: 1,
            title: title
        }, fn);
    }
    exports('aizxin', sow);
});