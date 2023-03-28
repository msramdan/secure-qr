<template>
    <div class="visible-print text-center">
        {{ qr }}
        <p>Scan me to return to the original page.</p>
    </div>
</template>

<script>
export default {
    props: {
        qr
    }
}
</script>