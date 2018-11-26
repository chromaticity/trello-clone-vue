<template>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div  class="m-b-md">
                <h2 class="title m-b-md">
                    Trellu
                </h2>
                <h3>
                    A clone of trello.
                </h3>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .full-height {
        height: 100vh;
    }
    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }
    .position-ref {
        position: relative;
    }
    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }
    .content {
        text-align: center;
    }
    .title {
        font-size: 80px;
    }
    .m-b-md {
        margin-bottom: 30px;
        color: #000000;
    }
</style>

<script>
	export default {}
</script>
