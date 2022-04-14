<script setup>

</script>

<template>
    <div>
        <div class="table-responsive">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <slot name="thead" />
                    </tr>
                </thead>
                <tbody>
                    <slot name="tbody" />
                </tbody>
            </table>
        </div>
    </div>
</template>

<style lang="scss">
@import "bootstrap/scss/tables";
</style>