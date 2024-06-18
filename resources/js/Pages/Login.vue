<template>
    <el-container class="login-container">
        <el-header>
            <h2>Login</h2>
        </el-header>
        <el-main>
            <el-form :model="form" ref="loginForm" label-width="100px">
                <el-form-item label="Username" prop="username" :error="errors.name">
                    <el-input v-model="form.name"></el-input>
                </el-form-item>
                <el-form-item label="Password" prop="password" :error="errors.password">
                    <el-input type="password" v-model="form.password"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="submit">Login</el-button>
                </el-form-item>
            </el-form>
        </el-main>
    </el-container>
</template>

<script setup>
import {reactive} from "vue";
import {router} from "@inertiajs/vue3";

const form = reactive({
    name: null,
    password: null
});

const errors = reactive({
    name: null,
    email: null,
    password: null
});
const submit = () => {
    router.post('login', form, {
        onError: (errorBag) => {
            for (const key in errors) {
                errors[key] = null;
            }
            for (const key in errorBag) {
                errors[key] = errorBag[key]; // Mostrar solo el primer error
            }
        }
    });
};
</script>

<script>
export default {
    layout: null
};
</script>

<style scoped>
.login-container {
    margin-left: 35%;
    width: 30%;
    margin-top:10%;
    padding: 1rem;
    border: 1px solid #dcdcdc;
    border-radius: 10px;
    box-shadow: 0 2px 12px 0 rgba(0,0,0,0.1);
}
</style>
