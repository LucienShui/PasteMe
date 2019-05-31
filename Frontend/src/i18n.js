/*
@File    :   i18n.js
@Contact :   lucien@lucien.ink
@License :   (C)Copyright 2019, Lucien Shui

@Modify Time      @Author    @Version    @Desciption
------------      -------    --------    -----------
2019-05-31 23:48  Lucien     1.0         None
*/
import Vue from 'vue'
import VueI18n from 'vue-i18n'

Vue.use(VueI18n);

export default new VueI18n({
    locale: 'zh-CN',
    messages: {
        'zh-CN': require('./assets/lang/zh-CN'),
        'en': require('./assets/lang/en'),
    }
});
