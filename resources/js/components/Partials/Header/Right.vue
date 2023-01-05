<template>
    <div class="hidden md:flex gap-12 items-center w-1/5 justify-end" v-if="!focused">
        <Dropdown>
            <template #label>ma{{ selectedClass.class.course.name }}</template>
            <template #items>
                <form v-for="theClass in unselectedClasses" action="/class" method="POST">
                    <input :value="theClass.id" name="class_id" type="hidden">
                    <button type="submit">ma{{ theClass.course.name }}</button>
                </form>
            </template>
        </Dropdown>

        <Dropdown>
            <template #label>{{ user.first_name }}</template>
            <template #items>
                <a class="flex gap-x-2 justify-between items-center" href="/profile">
                    <HeroUserSolidIcon class="h-8 w-8"/>
                    <span class="text-left w-full">{{ $t('Profile') }}</span>
                </a>
                <a class="flex gap-x-2 justify-between items-center" href="/settings">
                    <HeroSettingsSolidIcon class="h-8 w-8"/>
                    <span class="text-left w-full">{{ $t('Settings') }}</span>
                </a>
                <a class="flex gap-x-2 justify-between items-center" href="/logout">
                    <HeroLogoutSolidIcon class="h-8 w-8"/>
                    <span class="text-left w-full">{{ $t('Log out') }}</span>
                </a>
            </template>
        </Dropdown>
    </div>

    <button class="w-1/5 flex items-center justify-end" @click="unfocus" v-else>{{ $t('Close') }}</button>

</template>

<script setup>
import HeroUserSolidIcon from '@/icons/HeroUserSolidIcon';
import HeroSettingsSolidIcon from '@/icons/HeroSettingsSolidIcon';
import HeroLogoutSolidIcon from '@/icons/HeroLogoutSolidIcon';
import Dropdown from "@/components/Partials/Dropdown";

import useMainStore from '@/stores/main.js';
import useHeaderStore from '@/stores/header.js';

const {user, selectedClass, unselectedClasses} = useMainStore();
const {focused, unfocus} = useHeaderStore();

</script>
