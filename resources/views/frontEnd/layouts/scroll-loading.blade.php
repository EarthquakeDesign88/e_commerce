<div class="progressContainer">
    <div class="progressBar"></div>
</div>

<script>
    window.addEventListener('scroll', function(){
        let winTop = this.scrollY
        let navbar = document.querySelector(".navbar")

        let winHeight = this.innerHeight
        let docHeight = document.querySelector("body").offsetHeight
        let totalScroll = (winTop / (docHeight - winHeight)) * 100
        let bar = document.querySelector(".progressBar")
        bar.style.width = `${totalScroll}%`
        
        if(winTop > 300) {
            navbar.classList.remove("navbar-dark", "bg-transparent")
            navbar.classList.add("navbar-dark", "bg-dark")
        } else {
            navbar.classList.remove("navbar-dark", "bg-dark")
            navbar.classList.add("navbar-dark", "bg-transparent")
        }
    })
        
</script>

<style>
    .progressContainer{
        left: 0;
        width: 100%;
        height: 0.4em;
        margin-bottom: 0px;
        position: fixed;
        bottom: 0;
        overflow: hidden;
        background-color: #fff;
        content: "";
        display: table;
        table-layout: fixed;
        z-index: 9999;
    }

    .progressBar{
        width: 0%;
        float: left;
        height: 100%;
        z-index: 9999;
        max-width: 100%;
        background-color: #ffc700;
        -webkit-transition: width .6s ease;
        -o-transition: width .6s ease;
        transition: width .6s ease;
    }
</style>

