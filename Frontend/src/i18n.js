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

const i18n = new VueI18n({
    locale: 'zh-CN',
    messages: {
        'zh-CN': require('./assets/lang/zh-CN')
    }
});

const loadedLanguages = ['zh-CN'];
const supportedLanguage = ['zh-CN', 'en'];

Vue.prototype.setI18n = function (lang) {
    if (i18n.locale !== lang) {
        if (supportedLanguage.includes(lang)) {
            if (!loadedLanguages.includes(lang)) {
                import(`@/assets/lang/${lang}`).then(messages => {
                    i18n.setLocaleMessage(lang, messages);
                    loadedLanguages.push(lang);
                    i18n.locale = lang;
                });
            } else i18n.locale = lang;
        } else i18n.locale = supportedLanguage[0];
    }
};

export default i18n;
