import Router from 'vue-router'

import Home from '../pages/Home.vue';

import Levels from '../pages/Levels/Index.vue';
import LevelStore from '../pages/Levels/LevelStore.vue';
import LevelUpdate from '../pages/Levels/LevelUpdate.vue';

import Languages from '../pages/Languages/Index.vue';
import LanguageUpdate from '../pages/Languages/LanguageUpdate.vue';
import LanguageStore from '../pages/Languages/LanguageStore.vue';

import Sections from '../pages/Sections/Index.vue';
import SectionUpdate from '../pages/Sections/SectionUpdate.vue';
import SectionStore from '../pages/Sections/SectionStore.vue';

import Tasks from '../pages/Tasks/Index.vue';
import TaskUpdate from '../pages/Tasks/TaskUpdate.vue';
import TaskStore from '../pages/Tasks/TaskStore.vue';

import Templates from '../pages/Templates/Index.vue';


import NotFound from '../pages/404.vue';

const prefix = '/admin'
export default new Router({
    mode: 'history',
    routes: [
        {path: prefix+'/',
            component: Home, name: 'index'},

        {path: prefix+'/learning/levels',
            component: Levels, name: 'levels'},
        {path: prefix+'/learning/levels/edit=:id',
            component: LevelUpdate, name: 'level.edit'},
        {path: prefix+'/learning/levels/add',
            component: LevelStore, name: 'level.add'},

        {path: prefix+'/learning/languages',
            component: Languages, name: 'languages'},
        {path: prefix+'/learning/languages/edit=:id',
            component: LanguageUpdate, name: 'language.edit'},
        {path: prefix+'/learning/languages/add',
            component: LanguageStore, name: 'language.add'},
        {path: prefix+'/learning/sections/',
            component: Sections, name: 'sections'},
        {path: prefix+'/learning/sections/add',
            component: SectionStore, name: 'section.add'},
        {path: prefix+'/learning/sections/edit=:id',
            component: SectionUpdate, name: 'section.edit'},
        { path: prefix+'/learning/settings/templates',
            component: Templates, name: 'templatesTask'},
        { path: prefix+'/learning/section/:id/tasks/',
            component: Tasks, name: 'tasks'},
        { path: prefix+'/learning/task/add',
            component: TaskStore, name: 'task.add'},
        { path: prefix+'/learning/task/edit=:id',
            component: TaskUpdate, name: 'task.edit'},
        {path: prefix+'/404', name: '404',
            component: NotFound,
        },
        { path: '*',
            redirect: prefix+'/404'
        }

    ],
    scrollBehavior (to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        } else {
            return { x: 0, y: 0 }
        }
    }
})
