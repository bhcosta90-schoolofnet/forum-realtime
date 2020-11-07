<template>
    <div>
        <div class="card horizontal" v-for="(reply, i) in replies.data" :class="{'lime lighen-4' : reply.highlighted}" :key=i>
            <div class="card-images">
                <img :src="reply.user.photo_url" alt="">
            </div>

            <div class="card-stacked">
                <div class="card-content">
                    <span class="card-title">{{reply.user.name}} {{ replied }}</span>

                    <blockquote>
                        {{ reply.body }}
                    </blockquote>
                </div>
                <div class="card-action" v-if="logged.role === 'admin'">
                    <a :href="'/reply/highligth/' + reply.id">em destaque</a>
                </div>
            </div>
        </div>

        <div class="card grey lighten-4" v-if=!isClosed>
            <div class="card-content">
                <span class="card-title">{{ reply }}</span>
                <form @submit.prevent="save()">
                    <div class="input-field"><textarea class='materialize-textarea' v-model="form.reply_body" :placeholder="yourAnswer" name="" id="" cols="30" rows="10"></textarea></div>
                    <button type="submit" class="btn red accent-2">{{ send }}</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            "replied",
            "reply",
            "your-answer",
            "send",
            "is-closed",
            'thread-id',
            'fixed'
        ],
        mounted() {
            this.getReplies()
            Echo.channel(`new.reply.${this.threadId}`)
                .listen('NewReplyEvent', (e) => {
                    if (e.reply) {
                        this.getReplies();
                    }
                });
        },
        data() {
            return {
                replies: [],
                logged: window.user || {},
                form: {
                    replay_body: ""
                }
            }
        },
        methods: {
            getReplies() {
                window.axios.get(`/api/replies/${this.threadId}`).then(response => {
                    this.replies = response.data
                })
            },
            save() {
                window.axios.post(`/api/replies/${this.threadId}`, this.form).then(response => {
                    this.getReplies();
                    this.form = {};
                })
            },
            actionHighlighted(id)
            {
                window.axios.post(`/api/replies/${id}/highlighted`, {}).then(response => {
                    this.getReplies();
                })
            }
        },
    }
</script>
