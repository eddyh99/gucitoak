<style>
    /* .flip-container {
        perspective: 1000px;
        display: inline-block;
    } */

    .flipper {
        transition: transform 0.6s;
        transform-style: preserve-3d;
        position: relative;
    }

    .flipper.flip {
        transform: rotateY(180deg);
    }

    .img-preview {
        backface-visibility: hidden;
        display: block;
        transition: opacity 0.2s;
    }
</style>
<script>
    function previewImage() {
        const img = document.querySelector('#avatar');
        const imgPreviews = document.querySelectorAll('.img-preview');
        const blob = URL.createObjectURL(img.files[0]);
        imgPreviews.forEach(preview => {
            preview.classList.add("mb-3");
            preview.src = blob;
        });
    }

    $('.img-preview').on('click', function() {
        const $flipper = $(this).closest('.flipper');
        const current = $(this).attr('src');
        const next = $(this).data('barcode');

        // Flip animation
        $flipper.addClass('flip');

        // After animation halfway (300ms), change the image
        setTimeout(() => {
            $(this).attr('src', next);
            $(this).data('barcode', current);
        }, 300);

        // Reset after 600ms (animation complete)
        setTimeout(() => {
            $flipper.removeClass('flip');
        }, 600);
    });
</script>