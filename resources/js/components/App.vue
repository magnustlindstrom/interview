<template>
    <div :data-theme="activeTheme" class="min-h-screen bg-page">
        <Notification/>

        <Header/>

        <main id="content">
            <Home v-path:home/>
            <Learn v-path:learn/>
            <Review v-path:review/>
            <Profile v-path:profile/>
            <Settings v-path:settings/>
        </main>
    </div>
</template>

<script setup>
import Home from '@/components/Views/Home';
import Learn from '@/components/Views/Learn';
import Review from '@/components/Views/Review';
import Profile from '@/components/Views/Profile';
import Settings from '@/components/Views/Settings';
import Notification from '@/components/Partials/Notification';
import Header from '@/components/Partials/Header/Header';

import useMainStore from '@/stores/main';
import useThemeStore from '@/stores/theme';
import useNotificationsStore from '@/stores/notifications';

const {currentUrlSegmentIs} = useMainStore();
const {active: activeTheme} = useThemeStore();
const {add: addNotification} = useNotificationsStore();

const vPath = {
    mounted: (el, binding) => {
        const pathMatches = currentUrlSegmentIs(binding.arg);
        if (!pathMatches) el.remove()
    }
}
if(window.VUE_DATA.message)  addNotification('success', window.VUE_DATA.message)
else if(window.VUE_DATA.error)  addNotification('error', window.VUE_DATA.error)

</script>
