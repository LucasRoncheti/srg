   function mostrarLoader() {
            document.getElementById('loader').classList.remove('hidden');
        }

        function esconderLoader() {
            document.getElementById('loader').classList.add('hidden');
        }

        function innerLoader(){
            const body  = document.getElementsByTagName('body')
            body.innerHTML +=
              /*html*/
              `
               <div id="loader" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                    <div class="w-16 h-16 border-4 border-white border-t-transparent rounded-full animate-spin"></div>
                </div>
            `;
        }