<template>
    <div>
        <div class="card">
            <div class="card-content">
                <div class="card-title">{{ title }}</div>
                <table>
                    <thead>
                        <tr>
                            <th style="width:1px">#</th>
                            <th>{{ thread }}</th>
                            <th>{{ reply }}</th>
                            <th style="width:165px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(thread, i) in threads_response.data" :class="{'lime lighen-4' : thread.fixed}" :key="i">
                            <td>{{ thread.id }}</td>
                            <td>{{ thread.title }}</td>
                            <td>{{ thread.reply_count || 0 }} </td>
                            <td class='right-align'>
                                <a class='btn' :href="'/threads/' + thread.id">{{ open }}</a>
                                <a class='btn orange' v-show="logged.role === 'admin'" href="#" @click.prevent="actionFixed(thread.id)">{{ fixed }}</a>
                            </td>
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
            'send',
            'fixed'
        ],
        data() {
            return {
                threads_response: [],
                logged: window.user || {},
                form: {
                    title: "",
                    body: ""
                }
            }
        },
        mounted() {
            this.getThreads();
            Echo.channel('new.thread')
                .listen('NewThreadEvent', (e) => {
                    console.log(e)
                    if (e.thread) {
                        this.threads_response.data.splice(0, 0, e.thread)
                    }
                });
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
            },
            actionFixed(id) {
                window.axios.post(`/api/threads/${id}/fixed`).then(response => {
                    this.getThreads();
                });
            }
        },
    }
</script>
