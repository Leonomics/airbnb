import Home from '../pages/Home.vue'
import AdvancedSearch from '../pages/AdvancedSearch.vue'
import ApartmentsShow from '../pages/Apartments.show.vue'
import Page404 from '../pages/404.vue'

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
    },
    {
        path: '/ricerca-avanzata',
        name: 'advanced-search',
        component: AdvancedSearch,
        props: route => ({ 
            query: [
                route.query.lat,
                route.query.lon,
                route.query.addr
            ] 
        }),
    },
    {
        path: '/appartamento/:id',
        name: 'apartments.show',
        component: ApartmentsShow,
        props: true,
    },
    {
        path: '/*',
        name: '404',
        component: Page404,
    }
]

export default routes