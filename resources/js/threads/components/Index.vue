<template>
    <div>
        <div class="card">
            <div class="card-content">
                <div class="card-title">{{ title }}</div>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ thread }}</th>
                            <th>{{ reply }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(thread, i) in threads_response.data" :key="i">
                            <td>{{ thread.id }}</td>
                            <td>{{ thread.title }}</td>
                            <td>0</td>
                            <td><a :href="'/threads/' + thread.id">{{ open }}</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-title">{{ new_thread }}</div>
                <form @submit.prevent="save()">
                    <div class="input-field">
                        <input type="text" required :placeholder="thread_title" v-model="form.title" />
                    </div>
                    <div class="input-field">
                        <textarea type="text" required class="materialize-textarea" :placeholder="thread_body" v-model="form.body"></textarea>
                    </div>
                    <button type="submit" class="btn red aceent-2">{{ send }}</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'title',
            'thread',
            'reply',
            'open',
            'new_thread',
            'thread_title',
            'thread_body',
            'send'
        ],
        data() {
            return {
                threads_response: [],
                form: {
                    title: "",
                    body: ""
                }
            }
        },
        mounted() {
            this.getThreads();
        },
        methods: {
            getThreads() {
                window.axios.get('/api/threads').then(response => {
                    this.threads_response = response.data;
                });
            },
            save() {
                window.axios.post('/api/threads', this.form).then(response => {
                    this.getThreads();
                    this.form = {};
                })
            }
        },
    }
</script>
