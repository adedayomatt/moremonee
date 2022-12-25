import { App, plugin } from '@inertiajs/inertia-vue';
import { InertiaProgress } from '@inertiajs/progress';
import Vue from 'vue';
import VueLazyload from 'vue-lazyload';
import VueMeta from 'vue-meta';
import XSelect from 'vue-select';
import store from './store';

import AppButton from './components/AppButton.vue';
import AppInput from './components/XInput.vue';
import Modal from './components/Modal.vue';
import Avatar from './components/Avatar.vue';
import Pagination from './components/Pagination.vue';
import ModalVertical from './components/ModalVertical.vue';
import ModalConfirmation from './components/ModalConfirmation.vue';
import FileInput from "./components/FileInput";

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = Vue;

InertiaProgress.init();

Vue.use(plugin);
Vue.use(VueMeta);
Vue.use(VueLazyload);

Vue.mixin({
    methods: {
        route: window.route,
        hasKeys: (errors = {}) => !Object.keys(errors).length,
    },
});

Vue.filter('money', (value, currency = 'USD') => `${currency} ${new Intl.NumberFormat().format(value)}`);
Vue.filter('numberFormat', (value) => new Intl.NumberFormat().format(value));
Vue.filter('file', (bytes, si=false, dp=1) => {
    if (!bytes) return ;

    const thresh = si ? 1000 : 1024;

    if (Math.abs(bytes) < thresh) {
        return bytes + ' B';
    }

    const units = si
        ? ['kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']
        : ['KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB'];
    let u = -1;
    const r = 10**dp;

    do {
        bytes /= thresh;
        ++u;
    } while (Math.round(Math.abs(bytes) * r) / r >= thresh && u < units.length - 1);


    return bytes.toFixed(dp) + ' ' + units[u];
});
Vue.filter('datetime', (value) => {
    if (!value) return '';
    const dateTime = new Date(Date.parse(value));
    const date = `${dateTime.getDate()}/${dateTime.getMonth()}/${dateTime.getFullYear()}`;
    const time = `${dateTime.getHours()}:${dateTime.getMinutes()}:${dateTime.getSeconds()}`;
    return `${date} ${time}`;
});
Vue.filter('datetimeLong', (value) => {
    if (!value) return '';
    return dayjs(value).format('MMM D, YYYY h:mm A')
});
Vue.filter('dateLong', (value) => {
    if (!value) return '';
    return dayjs(value).format('MMM D, YYYY')
});
Vue.filter('date', (value) => {
    if (!value) return '';
    const dateTime = new Date(Date.parse(value));
    return `${dateTime.getDate()}/${dateTime.getMonth() + 1}/${dateTime.getFullYear()}`;
});

Vue.component(AppButton.name, AppButton);
Vue.component(AppInput.name, AppInput);
Vue.component(FileInput.name, FileInput);
Vue.component('XSelect', XSelect);
Vue.component(Modal.name, Modal);
Vue.component(Avatar.name, Avatar);
Vue.component(Pagination.name, Pagination);
Vue.component(ModalVertical.name, ModalVertical);
Vue.component(ModalConfirmation.name, ModalConfirmation);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = document.getElementById('app')

new Vue({
    store,
    metaInfo: {
        titleTemplate: (title) => title ? `${title} - MoreMonee` : 'MoreMonee',
    },
    render: h => h(App, {
        props: {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: name => import(`../../domain/${name}`).then(module => module.default),
        },
    }),
}).$mount(app);
