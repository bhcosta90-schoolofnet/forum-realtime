<template>
    <div>
        <div class="card">
            <div class="card-content"><span class="card-title">Erik {{replied}}</span></div>
            <blockquote>
                dwaodpkaodwkdkoak
            </blockquote>
        </div>

        <div class="card">
            <div class="card-content"><span class="card-title">Erik {{replied}}</span></div>
            <blockquote>
                dwaodpkaodwkdkoak
            </blockquote>
        </div>

        <div class="card">
            <div class="card-content"><span class="card-title">Erik {{replied}}</span></div>
            <blockquote>
                dwaodpkaodwkdkoak
            </blockquote>
        </div>

        <div class="card">
            <div class="card-content"><span class="card-title">Erik {{replied}}</span></div>
            <blockquote>
                dwaodpkaodwkdkoak
            </blockquote>
        </div>

        <div class="card grey lighten-4">
            <div class="card-content">
                <span class="card-title">{{ reply }}</span>
                <form action="">
                    <div class="input-field"><textarea class='materialize-textarea' :placeholder="yourAnswer" name="" id="" cols="30" rows="10"></textarea></div>
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
            "thread-id",
            "is-closed",
        ],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
