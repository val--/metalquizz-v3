import Home from './components/Home';
import About from './components/About';
import NotFound from './components/NotFound';

export default {
	mode: 'history',
	linkActiveClass: 'active-class-to-change',
	routes: [
		{
			path: '*',
			component: NotFound,
		},
		{
			path: '/',
			component: Home
		},
		{
			path: '/about',
			component: About
		}
	]
}