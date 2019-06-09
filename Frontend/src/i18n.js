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
    fallbackLocale: 'zh-CN',
    messages: {
        'zh-CN': require('./assets/lang/zh-CN')
    }
});

const loadedLanguages = ['zh-CN'];
const supportedLanguage = ['zh-CN', 'en'];

function setI18nLanguage(lang) {
    i18n.locale = lang;
    document.querySelector('html').setAttribute('lang', lang);
    return lang;
}

Vue.prototype.setI18n = function (lang) {
    if (i18n.locale !== lang) {
        if (supportedLanguage.includes(lang)) {
            if (!loadedLanguages.includes(lang)) {
                return import(/* webpackChunkName: "[request]" */ `./assets/lang/${lang}`).then(messages => {
                    i18n.setLocaleMessage(lang, messages);
                    loadedLanguages.push(lang);
                    return setI18nLanguage(lang);
                });
            }
            return Promise.resolve(setI18nLanguage(lang));
        }
        return Promise.reject(setI18nLanguage(supportedLanguage[0]));
    }
    return Promise.resolve(lang);
};

export default i18n;
