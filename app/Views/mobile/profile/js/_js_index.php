<style>
    .flipper {
        transition: transform 0.6s;
        transform-style: preserve-3d;
        position: relative;
    }

    .flipper.flip {
        transform: rotateY(180deg);
    }

    /*.img-preview {*/
    /*    backface-visibility: hidden;*/
    /*    display: block;*/
    /*    transition: opacity 0.2s;*/
    /*    margin-left: auto;*/
    /*    margin-right: auto;*/
    /*}*/

    .outer-wrapper {
      background-color: #d8ecfc;
      border-radius: 0.5rem;
      padding: 1.5rem;
      margin: 1rem;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .card-wrapper {
      background-color: #ffffff;
      border-radius: 0.5rem;
      padding: 1rem;
      text-align: center;
    }
    .flip-container .img-preview {
      width: 100%;
      max-width: 100%;
      height: auto;
      border-radius: 0.5rem;
    }
    .sales-name {
      margin-top: 1rem;
      font-size: 1.2rem;
      font-weight: 800;
      color: #2c3e50;
      text-align: center;
    }
    .company-info {
      margin-top: 1.5rem;
      font-size: 0.9rem;
    }
    .company-logo {
      height: 75px;
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