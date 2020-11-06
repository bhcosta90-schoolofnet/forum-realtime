<template>
    <div id='preloader' v-show="counter">
        <img src="/img/preloader.gif" alt="" srcset="">
    </div>
</template>

<script>
export default {
    data() {
        return  {
            'counter': 0
        }
    },
    mounted() {
        axios.interceptors.request.use(config => {
            this.counter++;
            return config
        }, error => {
            return Promise.reject(error);
        })

        axios.interceptors.response.use(response => {
            this.counter--;
            return response
        }, error => {
            this.counter--;
            return Promise.reject(error);
        })
    }
}
</script>

<style>
#preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.5);
}

#preloader img{
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    margin-top: 70px;
    margin-left: 70px;
    border: 3px solid #34495e;
    background: #FFF;
    border-radius: 100%;
    overflow: hidden;
}
</style>