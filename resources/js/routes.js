import Home from './components/Home';
import About from './components/About';
import NotFound from './components/NotFound';
import Login from './components/Login';
import Register from './components/Register';
import Dashboard from './components/Dashboard';

export default{
    mode: 'history',
    linkActiveClass: 'active-classe-to-change',
    routes: [
        {
            path: '*',
            component: NotFound
        },
        {
            path: '/',
            component: Home,
            name: "Home"
        },
        {
            path: '/about',
            component: About
        },
        {
            path: '/register',
            component: Register
        },
        {
            path: '/login',
            component: Login,
            name: 'Login'
        },
        {
            path: "/dashboard",
            name: "Dashboard",
            component: Dashboard,
			beforeEnter: (to, form, next) =>{
				axios.get('/api/authenticated').then(()=>{
					next()
				}).catch((error)=>{
					console.log(error);
					return next({ name: 'Login'})
				})
			}
       
          }
          
    ]
}