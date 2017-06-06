var Aizxin = Aizxin || {};
window.onload = function() {
    /**
     * 获取Aizxin基础配置
     * @type {object}
     */
    Aizxin.conf = window.conf;
    /* 基础对象检测 */
    Aizxin.conf || $.error("Aizxin基础配置没有正确加载！");
    Aizxin.var = null;
    /* 基础对象检测 */
    Aizxin.getV = function() {
        return Aizxin.var;
    };
    /* 基础对象检测 */
    Aizxin.setV = function(vvalue) {
        Aizxin.var = null;
        Aizxin.var = vvalue;
    };
    /**
     * 解析URL
     * @param  {string} url 被解析的URL
     * @return {object}     解析后的数据
     */
    Aizxin.parse_url = function(url) {
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

    Aizxin.parse_str = function(str) {
        var value = str.split("&"),
            vars = {},
            param;
        for (var i = 0; i < value.length; i++) {
            param = value[i].split("=");
            vars[param[0]] = param[1];
        }
        return vars;
    }
    Aizxin.U = function(url) {
        if (!url || url == '') return '';
        var info = this.parse_url(url),
            path = [],
            reg;
        /* 验证info */
        info.path || $.error("url格式错误！");
        url = info.path;
        url = Aizxin.conf.APP + "/" + url;
        return url;
    };
    //注册弹出方法
    Aizxin.layerOpen = function(title, url, w, h, type, form, index) {
        if (title == null || title == '') {
            title = false;
        };
        if (w == null || w == '') {
            w = 800;
        };
        if (h == null || h == '') {
            h = ($(window).height() - 300);
        };
        layer.open({
            type: type,
            area: [w + 'px', h + 'px'],
            fix: false,
            maxmin: true,
            shade: false,
            title: title,
            content: url,
            success: function(layero) {
                Aizxin.layerClose(index)
                if (type === 1) {
                    form.render()
                }
            }
        });
    };
    /**
     * 关闭弹出框口
     */
    Aizxin.layerClose = function(index) {
        layer.close(index);
    };
};