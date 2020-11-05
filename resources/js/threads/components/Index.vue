<template>
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
                    <tr>
                        <td>1</td>
                        <td>ooi tudo bem</td>
                        <td>4</td>
                        <td><a href="/threads/1">{{ open }}</a></td>
                    </tr>
                </tbody>
            </table>
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
        ],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
