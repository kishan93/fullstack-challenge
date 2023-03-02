<script setup>
import { Modal } from 'bootstrap'
import { onMounted, ref } from 'vue'

let modalElement = ref(null)
let thisModalObj = null


onMounted(() => {
  thisModalObj = new Modal(modalElement.value)
})

function _show() {
  thisModalObj.show()
}

defineExpose({ show: _show })

</script>

<template>
  <div
    class="modal fade"
    id="random-id-here"
    tabindex="-1"
    aria-labelledby=""
    aria-hidden="true"
    ref="modalElement"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            <slot name="title"></slot>
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <slot></slot>
        </div>
        <div class="modal-footer">
          <slot name="footer"></slot>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
