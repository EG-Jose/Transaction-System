<style>

footer{
    background-color: #111010;
}
.f-item-con{
    padding: 1.5rem 4rem;
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    grid-gap: 2rem;
}
footer .app-name{
    color: white;
    border-left: 4px solid var(--theme-col);
    padding-left: 1.5rem;
    font-size: 1.875rem;
    line-height: 2.25rem;
    font-weight: 700;
}
.app-name .app-initial{
    color: var(--theme-col);
}
footer .app-info p{
    color: white;
    padding-left: 1.65rem;
}

footer .footer-title{ 
    font-size: 1.25rem;
    line-height: 1.75rem;
    color: white;
    border-left: 4px solid var(--theme-col);
    padding-left: 1.5rem;
    height: fit-content;
}
footer ul{ 
    padding-left: 1.75rem;
    color: white;
    font-size: 0.875rem;
    line-height: 1.25rem;
    margin-top: .5rem;
}
footer ul li a{ 
    margin: .25rem 0;
    cursor: pointer;
    color: #d4d4d4;
    width: fit-content;
}

footer ul li a:hover{
    color: white;
}
footer .help-sec{
    grid-column-start: 2;
}
footer .cr-con{
    background-color: #232127;
    color: white;
    padding: 1rem 4rem;
    text-align: center;
}
.g-i-t{
    display: grid;
    grid-column-start: 3;
    grid-row-start: 1;
    grid-row-end: 3;
}
.g-i-t form{
    display: flex;
    flex-direction: column;
    margin-top: 1rem;
    --tw-space-y-reverse: 0;
    margin-top: calc(0.5rem * calc(1 - var(--tw-space-y-reverse)));
    margin-bottom: calc(0.5rem * var(--tw-space-y-reverse));
}
form .g-inp{
    padding: .25rem .5rem;
    font-size: 16px;
}
.g-inp textarea{
    height: 150px;
}
.f-btn{
    padding: .25rem 1rem;
    background-color: var(--theme-col);
    border-radius: .25rem;
    font-size: 16px;
    color: white;
    font-weight: 500;
}

</style>

<div class="f-item-con">
    <div class="app-info">
        <span class='app-name'>
            <span class='app-initial'>Triftee</span>
        </span>
        <p>
            
        </p>
    </div>
    <div class="useful-links">
        <div class="footer-title">Useful Links</div>
        <ul>
            <li><a onclick="showModal()">Sign In</a></li>
            <li>About Us</li>
            <li>Become an Affiliate</li>
            <li>Advertise with Us</li>
            <li>Terms and Conditions</li>
        </ul>
    </div>
    <div class="help-sec">
        <div class="footer-title">Help</div>
        <ul>
            <li><a onclick="helpMe()">Help Me</a></li>
            <li>Feedback</li>
            <li>Report a Issue / Bug</li>
        </ul>
    </div>
    <div class="g-i-t">
        <div class="footer-title">Get in Touch</div>
        <form action="/" method="post" class="space-y-2">
            <input type="text" name="g-name" class="g-inp" id="g-name" placeholder='Name' />
            <input type="email" name="g-email" class="g-inp" id="g-email" placeholder='Email' />
            <textarea type="text" name="g-msg" class="g-inp h-40 resize-none" id="g-msg"
                placeholder='Message...'></textarea>
            <button type="submit" class='f-btn'>Submit</button>
        </form>
    </div>
</div>
<div class='cr-con'>Copyright &copy;  Triftee 2024</div>

<script>
    function helpMe() {
        confirm("Help Yourself!");
    }
</script>