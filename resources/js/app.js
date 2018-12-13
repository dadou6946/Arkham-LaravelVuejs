import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './views/App'
import Home from './components/settings/Home'
import ChoosePlayers from './components/settings/ChoosePlayers'
import ChooseCharacters from './components/settings/ChooseCharacters'
import MixAllyPackage from './components/settings/MixAllyPackage'
import MixInvestigatorPackage from './components/settings/MixInvestigatorPackage'
import ChooseAncient from './components/settings/ChooseAncient'
import SetClues from './components/settings/SetClues'
import SetFixedObjects from './components/settings/SetFixedObjects'
import SetRandomObjects from './components/settings/SetRandomObjects'
import SetHealthSanity from './components/settings/SetHealthSanity'
import SetProperties from './components/settings/SetProperties'
import SetUpMonsters from './components/settings/SetUpMonsters'
import MixAncientPackage from './components/settings/MixAncientPackage'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/choose-characters',
            name: 'choose-characters',
            component: ChooseCharacters,
        },
        {
            path: '/choose-players',
            name: 'choose-players',
            component: ChoosePlayers,
        },
        {
            path: '/choose-ancient',
            name: 'choose-ancient',
            component: ChooseAncient,
        },
        {
            path: '/mix-ally-package',
            name: 'mix-ally-package',
            component: MixAllyPackage,
        },
        {
            path: '/set-clues',
            name: 'set-clues',
            component: SetClues,
        },
        {
            path: '/set-fixed-objects',
            name: 'set-fixed-objects',
            component: SetFixedObjects,
        },
        {
            path: '/mix-investigator-package',
            name: 'mix-investigator-package',
            component: MixInvestigatorPackage,
        },
        {
            path: '/set-random-objects',
            name: 'set-random-objects',
            component: SetRandomObjects,
        },
        {
            path: '/set-health-sanity',
            name: 'set-health-sanity',
            component: SetHealthSanity,
        },
        {
            path: '/set-properties',
            name: 'set-properties',
            component: SetProperties,
        },
        {
            path: '/set-up-monsters',
            name: 'set-up-monsters',
            component: SetUpMonsters,
        },
        {
            path: '/mix-ancient-package',
            name: 'mix-ancient-package',
            component: MixAncientPackage,
        },

    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
