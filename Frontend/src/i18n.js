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
}

Vue.prototype.setI18n = function (lang) {
    if (i18n.locale !== lang) {
        if (supportedLanguage.includes(lang)) {
            if (!loadedLanguages.includes(lang)) {
                import(/* webpackChunkName: "lang-[request]" */ `./assets/lang/${lang}`).then(messages => {
                    i18n.setLocaleMessage(lang, messages);
                    loadedLanguages.push(lang);
                    setI18nLanguage(lang);
                }).catch(error => {
                    alert(JSON.stringify(error));
                });
            } else setI18nLanguage(lang);
        } else setI18nLanguage(supportedLanguage[0]);
    }
};

export default i18n;
