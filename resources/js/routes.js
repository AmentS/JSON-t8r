import VueRouter from 'vue-router';



let routes = [
	{
		path: '/',
		component: require('./components/Translate').default

	},
	{


		path: '/newjson',
		component: require('./components/Newjson').default
	},
	{


		path: '/support',
		component: require('./components/Support').default
	}

]


export default new VueRouter({
    routes,
    linkActiveClass: 'is-active'

});