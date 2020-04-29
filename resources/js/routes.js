import VueRouter from 'vue-router';



let routes = [
	{
		path: '/',
		component: require('./components/TestPocetne').default

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