import {createApp} from 'vue';
import App from './src/App.vue';
import Router from './src/router/router';
import Antd from 'ant-design-vue';

createApp(App)
  .use(Antd)
  .use(Router)
  .mount('#app');