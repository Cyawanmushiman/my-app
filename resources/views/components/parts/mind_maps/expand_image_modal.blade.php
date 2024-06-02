<!-- モーダルのHTML -->
<div id="image-modal" style="display: none;">
    <div id="modal-content">
        <span id="close-modal">&times;</span>
        <img id="modal-image" src="" alt="Image">
    </div>
</div>

<style>
    /* モーダルのスタイル */
    #image-modal {
        position: fixed;
        z-index: 100;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }

    #modal-content {
        margin: 15% auto;
        padding: 2%;
        width: 80%;
        max-width: 700px;
        background-color: white;
        text-align: center;
        border-radius: 5px;
    }

    #close-modal {
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    #close-modal:hover,
    #close-modal:focus {
        color: #bd5d38;
        cursor: pointer;
    }

    #modal-image {
        width: 100%;
    }
</style>
