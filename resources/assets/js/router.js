import Vue from 'vue';
import Router from 'vue-router';

// 引用頁面的 Component
import example from './components/Example';
import home from './components/Home';
import hello from './components/Hello';
// 使用 Vue Router
Vue.use(Router);

// Route 設定
export const routes = [
//   { path: '/example', component: example, name:'example'},
  { path: '/home', component: home, name:'home'},
  { path: '/hello', name: 'hello', component: hello,},
    
    
];

// 建立 Vue Router instance
const router = new Router({
  mode: 'example', 
  router: routes,
  components: { example },
});

export default router;