<template>
    <div class="px-6 py-8 space-y-8">
        <h1 class="font-black text-3xl pb-4">{{ $t('Profile') }}</h1>

        <table>
            <tr>
                <td class="font-bold text-xl whitespace-nowrap px-2 py-4 align-top">{{ $t('First Name') }}:</td>
                <td class="px-2 py-4 align-top">{{ user.first_name }}</td>
            </tr>
            <tr>
                <td class="font-bold text-xl whitespace-nowrap px-2 py-4 align-top">{{ $t('Last Name') }}:</td>
                <td class="px-2 py-4 align-top">{{ user.last_name }}</td>
            </tr>
            <tr>
                <td class="font-bold text-xl whitespace-nowrap px-2 py-4 align-top">{{ $t('E-mail') }}:</td>
                <td class="px-2 py-4 align-top">{{ user.email }}</td>
            </tr>
            <tr>
                <td class="font-bold text-xl whitespace-nowrap px-2 py-4 align-top">{{ $t('Password') }}:</td>
                <td class="align-top">
                    <button v-if="!changePasswordStatus"
                            class="bg-button text-tertiary p-2 m-2 rounded-md text-tertiary" @click="changePassword">
                        {{ $t("Change Password") }}
                    </button>
                    <table v-cloak :class="{'hidden': !changePasswordStatus}" class="py-2">
                        <tr>
                            <td class="p-2 align-top">
                                <label for="old-password">{{ $t('Please enter your old password') }}: </label>
                            </td>
                            <td class="p-2">
                                <input v-model="oldPassword" :class="{'border border-red-400': !isValid('oldPassword')}" class="rounded-md"
                                       name="old-password"
                                       type="password">
                                <div v-if="!isValid('oldPassword')" class="text-red-400 text-sm">
                                    {{ validate('oldPassword') }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-2 align-top"><label for="password">{{ $t('Please enter your new password') }}: </label>
                            </td>
                            <td class="p-2">
                                <input v-model="newPassword" :class="{'border border-red-400': !isValid('newPassword')}" class="rounded-md"
                                       name="password"
                                       type="password">
                                <div v-if="!isValid('newPassword')" class="text-red-400 text-sm">
                                    {{ validate('newPassword') }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-2 align-top"><label for="check-password">{{ $t('Confirm your password') }}: </label></td>
                            <td class="p-2">
                                <input v-model="confirmPassword" :class="{'border border-red-400': !isValid('confirmPassword')}" class="rounded-md"
                                       name="check-password"
                                       type="password" @keyup.enter="updatePassword"
                                >
                                <div v-if="!isValid('confirmPassword')" class="text-red-400 text-sm">
                                    {{ validate('confirmPassword') }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="flex justify-end gap-3 pt-4">
                                    <button :class="{'bg-gray-300 hover:bg-gray-300 text-gray-700 cursor-not-allowed': !canSubmit() }"
                                            class="bg-green-300 hover:bg-green-400 text-green-700 px-4 py-2 rounded-md"
                                            @click="updatePassword">
                                        {{ $t("Update Password") }}
                                    </button>
                                    <button
                                        class="bg-yellow-400 hover:bg-yellow-500 px-4 py-2 text-yellow-800 rounded-md"
                                        @click="changePasswordStatus = false">{{ $t("Cancel") }}
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!--            <tr>-->
            <!--                <td class="font-bold text-xl whitespace-nowrap px-2 py-4 align-top">{{ $t('School') }}:</td>-->
            <!--                <td class="px-2 py-4 align-top">{{ school.name }}</td>-->
            <!--            </tr>-->
            <!--            <tr>-->
            <!--                <td class="font-bold text-xl whitespace-nowrap px-2 py-4 align-top">{{ $t('Province') }}:</td>-->
            <!--                <td class="px-2 py-4 align-top">{{ details.region.name }}</td>-->
            <!--            </tr>-->
        </table>
    </div>
</template>

<script setup>
import {ref} from 'vue';
import {trans} from 'laravel-vue-i18n';

import useMainStore from '@/stores/main';
import useNotificationsStore from '@/stores/notifications';

const {user} = useMainStore();
const {add: addNotification} = useNotificationsStore();

const changePasswordStatus = ref(false);
const changePassword = () => changePasswordStatus.value = true

const oldPassword = ref(null);
const newPassword = ref(null);
const confirmPassword = ref(null);

const isValid = (field) => validate(field) === null

const validate = (field) => {
    if (field === 'oldPassword' && oldPassword.value !== null && oldPassword.value.length == 0) {
        return trans("You must enter the old password.");
    }

    if (field === 'newPassword' && newPassword.value !== null && newPassword.value.length == 0) {
        return trans("You must enter the new password.");
    }

    if (field === 'confirmPassword' && confirmPassword.value !== newPassword.value) {
        return trans("Passwords do not match.");
    }
    return null;
}

const canSubmit = () => {
    return oldPassword != null
        && newPassword != null
        && validate('oldPassword') === null
        && validate('newPassword') === null
        && validate('confirmPassword') === null
}

const updatePassword = () => {
    if (!canSubmit()) return;
    axios.get('/sanctum/csrf-cookie').then(response => {
        axios.post(
            '/api/update-password',
            {newPassword, oldPassword}
        ).then((res) => {
            const message = trans('Password successfully updated!');
            addNotification('success', message);
        }).catch(data => {
            const message = trans('Could not update password!');
            addNotification('error', message)
        }).then(() => {
            changePasswordStatus.value = false;
            oldPassword.value = null;
            newPassword.value = null;
            confirmPassword.value = null;
        });
    });
}
</script>
