document.addEventListener('alpine:init', () => {
    Alpine.data('storeCreate', () => ({
        serverData,
        serverImages: [],
        get maxImage() {         
            return this.serverImages.length + serverData.image.length < 4
        },
        async storeImage(el) {
            const files = el.files
            const image = await this.compressImage(files[0], {
                // 0: is maximum compression
                // 1: is no compression
                quality: 0.5,

                // We want a JPEG file
                type: files[0].type,
            });

            const fileReader = new FileReader();
            const serverImages = this.serverImages;

            fileReader.onload = (e) => {
                const formData = new FormData()
                formData.append('image', image, files[0].name)
                axios.post('/image/pre-upload', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then(res => {
                        serverImages.push({ id: res.data.id, url: e.target.result })
                    })
                    .catch(error => {
                        alert('error');
                        console.error(error);
                    })
            }

            fileReader.readAsDataURL(image);
        },

        async compressImage(file, { quality = 1, type = file.type }) {
            // Get as image data
            const imageBitmap = await createImageBitmap(file);

            // Draw to canvas
            const canvas = document.createElement('canvas');
            canvas.width = imageBitmap.width;
            canvas.height = imageBitmap.height;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(imageBitmap, 0, 0);

            // Turn into Blob
            return await new Promise((resolve) =>
                canvas.toBlob(resolve, type, quality)
            );
        }
    }))
})