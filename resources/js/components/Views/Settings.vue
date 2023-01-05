<template>
    <div class="px-6 py-8 space-y-8">
        <h1 class="font-black text-3xl pb-4">{{ $t('Settings') }}</h1>
        <table>
            <tr>
                <td class="font-bold text-xl whitespace-nowrap px-2 py-4 align-text-top">{{ $t('Goal grade') }}:</td>
                <td class="px-2 py-4 align-text-top">{{ (selectedClass.grade ?? '').toUpperCase() }}</td>
            </tr>
            <tr>
                <!-- TODO: Text is not at the top despite align-text-top -->
                <td class="font-bold text-xl whitespace-nowrap px-2 py-4 align-top">{{ $t('Theme') }}:</td>
                <td class="px-2 py-4 align-text-top">
                    <fieldset>
                        <div class="flex flex-wrap justify-start items-center gap-4">
                            <div v-for="theme in themeOptions" class="w-1/3 md:w-auto">
                                <label :class="{
                                                'ring ring-offset-1': theme == activeTheme,
                                                'ring-gray-300': ['nice', 'energy', 'ocean'].includes(activeTheme)
                                        }" :data-theme="theme"
                                       :for="`theme-${theme}`"
                                       class="-m-0.5 relative p-1 rounded-full flex items-center justify-between cursor-pointer focus:outline-none ring-primaryrounded-full overflow-hidden gap-2"
                                       @click="changeTheme(theme)">
                                    <input :name="`theme-${theme}`" :theme="theme"
                                           aria-labelledby="color-choice-0-label" class="sr-only"
                                           name="color-choice" type="radio">
                                    <p id="color-choice-0-label" class="sr-only">{{ theme }}</p>

                                    <div class="flex items-center justify-center">
                                <span aria-hidden="true"
                                      class="h-8 w-4 bg-primary border border-black border-opacity-10 rounded-l-full"></span>
                                        <span aria-hidden="true"
                                              class="h-8 w-4 bg-tertiary border border-black border-opacity-10 rounded-r-full"></span>
                                    </div>
                                    <div class="capitalize">{{ theme }}</div>
                                </label>
                            </div>
                        </div>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <td class="font-bold text-xl whitespace-nowrap px-2 py-4 align-text-top">{{ $t('Language') }}:</td>
                <td class="px-2 py-4 align-text-top">
                    <div class="max-w-fit">
                        <Dropdown>
                            <template #label>
                                <component :is="getCurrentLanguage.flag" class="h-5 rounded-md"></component>
                            </template>
                            <template #items>
                                <a v-for="lang in languageOptions"
                                   :href="`/change-locale/${lang.slug}`"
                                   class="-m-3 p-3 flex items-start rounded-lg hover:bg-gray-50">
                                    <component :is="lang.flag" class="h-5 rounded-md"></component>
                                    <div class="ml-4">
                                        <p class="text-base font-medium text-gray-900">
                                            {{ (lang.label.charAt(0).toUpperCase() + lang.label.slice(1)) }}</p>
                                    </div>
                                </a>
                            </template>
                        </Dropdown>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</template>

<script setup>
import {unref} from 'vue'
import useMainStore from '@/stores/main'
import useThemeStore from '@/stores/theme'

import Dropdown from '@/components/Partials/Dropdown'
import BritishFlagIcon from '@/icons/Flags/BritishFlagIcon'
import SwedishFlagIcon from '@/icons/Flags/SwedishFlagIcon'
import Language from '@/models/Language'

const {locale, selectedClass} = useMainStore();
const {active: activeTheme, options: themeOptions, change: changeTheme} = useThemeStore();

const languageOptions = [
    new Language('en', 'English', BritishFlagIcon),
    new Language('sv_SE', 'Swedish', SwedishFlagIcon),
]

const getCurrentLanguage = languageOptions.find(l => l.slug == unref(locale))
</script>
