
  
  <section>
    <h1 class="Capsule">What we are looking for</h1> <!--capsule class-->
        <p>
            We are seeking a highly skilled and motivated Software Developer with a strong foundation in computer science and hands-on experience in full-stack development. The ideal candidate will hold a bachelor’s degree in Computer Science, Software Engineering, 
            or a related field, and have at least 2–3 years of professional experience in software development. Proficiency in programming languages such as JavaScript, Python, or Java is required, along with experience in frameworks like React, Node.js, or Django. 
            Candidates should be familiar with version control systems (e.g., Git), agile development methodologies, and database technologies such as SQL or MongoDB. Strong problem-solving skills, the ability to work collaboratively in a team environment, and excellent communication are essential for success in this role.
        </p>
    </section>
    <aside> <!--images using aside factor-->
        <img src="styles/images/success.jpg" alt="CSSIMAGE" class="image4"/>
        <img src="styles/images/csstransparent.png" alt="CSSIMAGE" class="image5"/>
        <img src="styles/images/HTMLIMAGETRANSPARENT.png" alt="HTMLIMAGE" class="image6"/>
    </aside>



    <section>
       <h1 class="Capsule">Why you should Apply with us? </h1> <!--uses the capsule class in order to make the blue backgrond-->
        <p>If you're passionate about innovation, growth and making a real impact in the world, our company is the perfect place for you.
            At Nexa-Soft Technologies, we harbour and develop a talented community of professionals dedicated to solving real-world problems with cutting-edge solutions.
            Here, your contribution is both valued and makes a difference. Surrounded by a supportive environment aswell as being equipped with state-of-the-art technology, opportunities go from bounded to endless.
            Apply with us if you want to be apart of something bigger.
            </p> <!--paragraph created with chatgpt-->
    </section>



<section>
    <h1 class="ApplicationTitle">Application</h1>

    <form id="survey" method="post" action="https://mercury.swin.edu.au/it000000/formtest.php">
        <data> 
            <div class="Item1"> 
                <h3>Reference Details</h3>
                <p>
                    <label for="Job Reference Number">Job Reference Number</label>
                    <select name="reference number" id="reference number" required="required">
                        <option value="" selected="selected">Please Select</option>
                        <option value="GO1">GO1-Software Developer</option>
                        <option value="GO2">GO2-Network Administrator</option>
                        <option value="GO3">GO3-Data Analyst</option>
                        <option value="GO4">GO4-Cybersecurity Specialist</option>
                        <option value="GO5">GO5-IT Support Technician</option>
                        <option value="GO6">GO6-Cloud Engineer</option>
                        <option value="GO7">GO7-AI/ML Engineer</option>    
                    </select>
                </p>
            </div>

            <div class="Item2">
                <h3>Personal Details</h3>
                <p>
                    <label>Given Name
                        <input type="text" name="Given Name" id="tbFirstname" maxlength="20" pattern="^[a-zA-Z]+$" required="required"
                        placeholder="Please Enter Here"/>
                    </label>
                </p>
                <p>
                    <label>Last Name
                        <input type="text" name="Last Name" id="tbLastbame" maxlength="20" pattern="^[a-zA-Z]+$" required="required"
                        placeholder="Please Enter Here"/>
                    </label>
                </p>

                <p>
                    <label>Date of Birth
                        <input type="text" 
                            name="Date Of Birth"
                            placeholder="dd/mm/yy"
                            pattern="\d{1,2}\/\d{1,2}\/\d{4}" 
                            required="required"/>
                    </label>
                </p>

                <fieldset>
                    <legend><label>Gender</label></legend>
                    <p>
                        <label><input type="radio" name="Gender" value="Male" /> Male </label>
                        <label><input type="radio" name="Gender" value="Female" /> Female </label>
                        <label><input type="radio" name="Gender" value="Unpreferred" /> Prefer Not To Say </label>
                    </p>
                </fieldset>
            </div>

            <div class="Item3">
                <h3>Postal Details</h3>
                <p>
                    <label>Street Address 
                        <input type="text" name="Street Address" id="tbStreetaddress" maxlength="40" pattern="^[a-zA-Z]+[1-0]+$" required="required"
                        placeholder="Please Enter Here"/>
                    </label>
                </p>

                <p>
                    <label>Suburb
                        <input type="text" name="Suburb" id="tbSuburb" maxlength="40" pattern="^[a-zA-Z]+[1-0]+$" required="required"
                        placeholder="Please Enter Here"/>
                    </label>
                </p>

                <p>
                    <label for="State">State</label>
                    <select name="State" id="state">
                        <option value="" selected="selected">Please Select</option>
                        <option value="Victoria">Victoria</option>
                        <option value="New South Wales">New South Wales</option>
                        <option value="Queensland">Queensland</option>
                        <option value="Northern Territory">Northern Territory</option>
                        <option value="West Australia">West Australia</option>
                        <option value="South Australia">South Australia</option>
                        <option value="Tasmania">Tasmania</option>
                        <option value="Australian Capital Territory">Australian Capital Territory</option>
                    </select>   
                </p>

                <p>
                    <label>Postcode</label>
                    <input type="text" 
                        name="Postcode"
                        placeholder="Please Enter Here"
                        maxlength="4"
                        required="required"
                        pattern="[200-9944]{4}"/>
                </p>
            </div>

            <div class="Item4"> 
                <h3>Contact Details</h3>

                <p>
                    <label for="Email Address">Email Address
                        <input type="email" id="email" name="Email Address"
                        placeholder="Please Enter Here"
                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
                        required="required"/>
                    </label>
                </p>

                <p>
                    <label for="number">Phone Number</label>
                    <input type="telephone" id="number" name="Phone Number"
                    placeholder="Please Enter Here"
                    pattern="\\d{4}\ \d{4}-\d{4}"
                    required="required"/>
                </p>
            </div>

            <div class="Item5">
                <h3>Other Details</h3>

                <p>
                    <label for="checkbox">Required Technical List</label>
                </p>
                <p>
                    <input type="checkbox" name="Required Technical List" value="JavaScript" checked="checked"/> JavaScript
                    <input type="checkbox" name="Required Technical List" value="HTML" checked="checked"/> HTML
                    <input type="checkbox" name="Required Technical List" value="CSS" checked="checked"/> CSS
                </p>

                <p>
                    <label>Other Skills<br />
                        <textarea name="Other Skills" rows="30" cols="30"></textarea>
                    </label>
                </p>
            </div>
        </data>

        <p>
            <input type="submit" value="Apply"/>
        </p>
    </form>
</section>