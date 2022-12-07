<template>
    <div class="container rounded bg-white mt-5">
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <form action="">
                        <input type="file" ref="myImage" class="form-control" @change="updateProfilePicture()">
                    </form>
                    <p v-if="status">Uploading...<br>
                        <img class="rounded-circle mt-5" :src="previewImage" width="90">
                    </p>
                    <img v-else class="rounded-circle mt-5" src="https://i.imgur.com/0eg0aG0.jpg" width="90">
                    <span class="font-weight-bold">John Doe</span>
                    <span class="text-black-50">john_doe12@bbb.com</span>
                    <span>United States</span>
                </div>
            </div>
            <div class="col-md-8">
                <form @submit.prevent="formOnSubmit" method="POST">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex flex-row align-items-center back"><i
                                    class="fa fa-long-arrow-left mr-1 mb-1"></i>
                                <h6>Back to home</h6>
                            </div>
                            <h6 class="text-right">Edit Profile</h6>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6" id="firstname">First name<input type="text" class="form-control"
                                    placeholder="first name" v-model="formData.firstname"></div>
                            <span v-for="error in v$.firstname.$errors" :key="error.$uid" class="error-red">
                                {{ error.$message }}
                            </span>
                            <div class="col-md-6">Last name
                                <input type="text" v-model="formData.lastname" class="form-control" placeholder="Doe">
                            </div>

                            <span v-for="error in v$.lastname.$errors" :key="error.$uid" class="error-red">
                                {{ error.$message }}
                            </span>

                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">About me
                                <textarea class="form-control" v-model="formData.about" cols="" rows=""></textarea>
                            </div>
                            <span v-for="error in v$.about.$errors" :key="error.$uid" class="error-red">
                                {{ error.$message }}
                            </span>
                        </div>
                        <div class="row mt-3">Availibility
                            <div class="col-md-6">
                                <label class="checkbox-inline">
                                    <li v-for="(day, index) in days" key="index">
                                        <input type="checkbox" v-model="formData.numberOfDays" :value="day.name">
                                        {{ day.name }}
                                    </li>
                                    {{ formData.numberOfDays }}
                                </label>
                                <span v-for="error in v$.numberOfDays.$errors" :key="error.$uid" class="error-red">
                                    {{ error.$message }}
                                </span>
                            </div>
                            <div class="form-inline">
                                Not available from:<input type="date" class="form-control">
                                Not available to:<input type="date" class="form-control">
                            </div>
                        </div>

                        <div class="row profile-row">
                            <div class="col-md-2 fw-form-label pt-2">
                                Website
                            </div>
                            <div class="col-md-10 d-flex flex-wrap align-content-center">
                                <div class="row w-100">
                                    <div class="col-md d-flex">
                                        <div id="fieldset-website" role="group" class="form-group flex-fill">
                                            <!---->
                                            <div class="bv-no-focus-ring"><input id="input-website" name="website"
                                                    type="text" placeholder="https://" class="form-control">
                                                <div tabindex="-1" role="alert" aria-live="assertive" aria-atomic="true"
                                                    class="invalid-feedback">Please enter a valid website URL.</div>
                                                <!---->
                                                <!---->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row profile-row">
                            <div class="col-md-2 fw-form-label pt-2">
                                Github
                            </div>
                            <div class="col-md-10 d-flex flex-wrap align-content-center">
                                <div class="row w-100">
                                    <div class="col-md d-flex">
                                        <div id="fieldset-github" role="group" class="form-group flex-fill">
                                            <!---->
                                            <div class="bv-no-focus-ring"><input id="input-github" name="github"
                                                    type="text" placeholder="https://github.com/" class="form-control">
                                                <div tabindex="-1" role="alert" aria-live="assertive" aria-atomic="true"
                                                    class="invalid-feedback">Please enter a GitHub handle.</div>
                                                <!---->
                                                <!---->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row profile-row">
                            <div class="col-md-2 fw-form-label pt-2">
                                LinkedIn
                            </div>
                            <div class="col-md-10 d-flex flex-wrap align-content-center">
                                <div class="row w-100">
                                    <div class="col-md d-flex">
                                        <div id="fieldset-linkedin" role="group" class="form-group flex-fill">
                                            <!---->
                                            <div class="bv-no-focus-ring"><input id="input-linkedin" name="linkedin"
                                                    type="text" placeholder="https://www.linkedin.com/"
                                                    class="form-control">
                                                <div tabindex="-1" role="alert" aria-live="assertive" aria-atomic="true"
                                                    class="invalid-feedback">Please enter a LinkedIn handle.</div>
                                                <!---->
                                                <!---->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row profile-row">
                            <div class="col-md-2 fw-form-label pt-2">
                                Agency
                            </div>
                            <div class="col-md-10 d-flex flex-wrap align-content-center">
                                <div class="row w-100">
                                    <div class="col-md d-flex">
                                        <div id="fieldset-agencyName" role="group" class="form-group flex-fill">
                                            <!---->
                                            <div class="bv-no-focus-ring"><input id="input-agencyName" name="agencyName"
                                                    type="text"
                                                    placeholder="If you work in a dev shop (agency), please type its name here."
                                                    class="form-control">
                                                <div tabindex="-1" role="alert" aria-live="assertive" aria-atomic="true"
                                                    class="invalid-feedback">Please enter an agency name.</div>
                                                <!---->
                                                <!---->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row profile-row">
                            <div class="col-md-2 fw-form-label pt-2">
                                Video
                            </div>
                            <div class="col-md-10 d-flex flex-wrap align-content-center">
                                <div class="row w-100">
                                    <div class="col-md"><input type="file" accept=".mp4, .mov" style="display: none;">
                                        <!---->
                                        <!---->
                                        <div><button type="button" class="btn btn-sm btn-outline-primary">Upload a
                                                Video</button>
                                            <div class="d-inline-block ml-2">New! Increase your visibility 10X with a
                                                1-minute
                                                self-introduction video!</div>
                                        </div>
                                        <!---->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row profile-row">
                            <div class="col-md-2 fw-form-label">
                                Work Types *
                            </div>
                            <div class="col-md-10 d-flex flex-wrap align-content-center">
                                <div class="row w-100">
                                    <div class="col-md"><input type="hidden" name="jsonWorktypeIds" value="[2,3,4,1]">
                                        <div id="worktypes-checkbox-form-group" role="group" class="form-group">
                                            <!---->
                                            <div class="bv-no-focus-ring">
                                                <div id="worktypes-checkbox-group" role="group" tabindex="-1"
                                                    class="bv-no-focus-ring">
                                                    <div class="custom-control custom-control-inline custom-checkbox">
                                                        <input type="checkbox" name="worktypes-checkbox-group"
                                                            class="custom-control-input" value="1"
                                                            v-model="formData.workType" id="__BVID__21"><label
                                                            class="custom-control-label" for="__BVID__21">
                                                            Freelancer
                                                        </label>
                                                    </div>
                                                    <div class="custom-control custom-control-inline custom-checkbox">
                                                        <input type="checkbox" name="worktypes-checkbox-group"
                                                            class="custom-control-input" value="2"
                                                            v-model="formData.workType" id="__BVID__22"><label
                                                            class="custom-control-label" for="__BVID__22">
                                                            Employee
                                                        </label>
                                                    </div>
                                                    <div class="custom-control custom-control-inline custom-checkbox">
                                                        <input type="checkbox" name="worktypes-checkbox-group"
                                                            class="custom-control-input" value="3"
                                                            v-model="formData.workType" id="__BVID__23"><label
                                                            class="custom-control-label" for="__BVID__23">
                                                            Temp
                                                        </label>
                                                    </div>
                                                    <div class="custom-control custom-control-inline custom-checkbox">
                                                        <input type="checkbox" name="worktypes-checkbox-group"
                                                            class="custom-control-input" value="4"
                                                            v-model="formData.workType" id="__BVID__24"><label
                                                            class="custom-control-label" for="__BVID__24">
                                                            Intern
                                                        </label>
                                                    </div>
                                                </div>
                                                <span v-for="error in v$.workType.$errors" :key="error.$uid"
                                                    class="error-red">
                                                    {{ error.$message }}
                                                </span>
                                                <!---->
                                                <!---->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row profile-row">
                            <div class="col-md-2 fw-form-label pt-2">
                                Skills *
                            </div>
                            <div class="col-md-10 d-flex flex-wrap align-content-center"><input type="hidden"
                                    id="input-skillIds" name="jsonSkillIds" value="[9,27,65,66,102,104]">
                                <fieldset id="fieldset-allSkills" class="form-group is-valid">
                                    <!---->
                                    <div tabindex="-1" role="group" class="bv-no-focus-ring">
                                        <div class="skilltype-group">
                                            <div class="skilltype-title">
                                                Programming Languages
                                            </div>
                                           
                                           
                                            <div class="d-inline-block">

                                                <div >
                                                    <button v-for="(programming, index) in userBasedSkillList.programming" type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        {{programming}}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="skilltype-title">
                                                Frameworks
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button v-for="(framework, index) in userBasedSkillList.framework" type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        {{framework}}
                                                    </button></div>
                                            </div>
                                        </div>
                                        <div class="skilltype-group">
                                            <div class="skilltype-title">
                                                Operating Systems
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Linux
                                                    </button></div>
                                            </div>
                                         
                                           
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        iOS
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Android
                                                    </button></div>
                                            </div>
                                            
                                        </div>
                                        <div class="skilltype-group">
                                            <div class="skilltype-title">
                                                Business
                                            </div>
                                            
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Business
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Marketing
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Sales
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Product Management
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Design
                                                    </button></div>
                                            </div>
                                           
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        English
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Japanese
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Chinese
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        French
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Spanish
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        German
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Portugese
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Dutch
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Russian
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Arabic
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Punjabi
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Hindi
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Bengali
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Tagalog
                                                    </button></div>
                                            </div>
                                            
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Kubernetes
                                                    </button></div>
                                            </div>
                                            
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Gasby
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        TensorFlow
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Unity3D
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Unreal Engine
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Ansible
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Puppet
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Chef
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Flutter
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Teraform
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Keras
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Cordova
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Xamarin
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Hadoop
                                                    </button></div>
                                            </div>
                                            
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Azure
                                                    </button></div>
                                            </div>
                                            
                                        </div>
                                        <div class="skilltype-group">
                                            <div class="skilltype-title">
                                                Databases
                                            </div>
                                           
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        SQL
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        MySQL
                                                    </button></div>
                                            </div>
                                            
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        MongoDB
                                                    </button></div>
                                            </div>
                                            
                                            
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        PostgreSQL
                                                    </button></div>
                                            </div>
                                            
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        MS SQL Server
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        SQLite
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Redis
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        MariaDB
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Oracle
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Firebase
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        ElasticSearch
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        DynamoDB
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Couchbase
                                                    </button></div>
                                            </div>
                                            
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        Drupal
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="false" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm"
                                                        style="display: inline-block;">
                                                        WordPress
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <div><button type="button" aria-pressed="true" autocomplete="off"
                                                        class="btn skill-btn btn-outline-secondary btn-sm active selected"
                                                        style="display: inline-block;">
                                                        Odoo
                                                    </button></div>
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                            <div class="d-inline-block">
                                                <!---->
                                            </div>
                                        </div>
                                        <div tabindex="-1" role="alert" aria-live="assertive" aria-atomic="true"
                                            class="invalid-feedback">Please select at least one skill.</div>
                                        <!---->
                                        <!---->
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row profile-row">
                            <div class="col-md-2 fw-form-label pt-2">
                                Additional Skills
                            </div>
                            <div class="col-md-10 d-flex flex-wrap align-content-center w-100"
                                style="margin-bottom: 15px;"><input type="hidden" id="input-Tags" name="jsonTags">
                                <div data-v-61d92e31="" class="vue-tags-input w-100">
                                    <div data-v-61d92e31="" class="ti-input">
                                        <ul data-v-61d92e31="" class="ti-tags">
                                            <li data-v-61d92e31="" tabindex="0" class="ti-tag ti-valid">
                                                <div data-v-61d92e31="" class="ti-content">
                                                    <!---->
                                                    <div data-v-61d92e31="" class="ti-tag-center"><span
                                                            data-v-61d92e31="" class="">mm,mm</span>
                                                        <!---->
                                                    </div>
                                                    <!---->
                                                </div>
                                                <div data-v-61d92e31="" class="ti-actions"><i data-v-61d92e31=""
                                                        class="ti-icon-undo" style="display: none;"></i> <i
                                                        data-v-61d92e31="" class="ti-icon-close"></i>
                                                    <!---->
                                                </div>
                                            </li>
                                            <li data-v-61d92e31="" tabindex="0" class="ti-tag ti-valid">
                                                <div data-v-61d92e31="" class="ti-content">
                                                    <!---->
                                                    <div data-v-61d92e31="" class="ti-tag-center"><span
                                                            data-v-61d92e31="" class="">mmmm</span>
                                                        <!---->
                                                    </div>
                                                    <!---->
                                                </div>
                                                <div data-v-61d92e31="" class="ti-actions"><i data-v-61d92e31=""
                                                        class="ti-icon-undo" style="display: none;"></i> <i
                                                        data-v-61d92e31="" class="ti-icon-close"></i>
                                                    <!---->
                                                </div>
                                            </li>
                                            <li data-v-61d92e31="" class="ti-new-tag-input-wrapper"><input
                                                    data-v-61d92e31="" placeholder="Add Skill" type="text" size="1"
                                                    class="ti-new-tag-input ti-valid"></li>
                                        </ul>
                                    </div>
                                    <!---->
                                </div>
                            </div>
                        </div>
                        <div class="row profile-row">
                            <div class="col-md-2 fw-form-label">
                                Location *
                            </div>
                            <div class="col-md-10 d-flex flex-wrap align-content-center">
                                <div class="row w-100">
                                    <div class="col-md-6">
                                        <div class="pl-4 ml-1 custom-control custom-checkbox">
                                            <input v-model="formData.workPreference"
                                                id="checkbox_is_remote" type="checkbox" name="checkbox_is_remote"
                                                aria-required="true" class="custom-control-input" value="remote"><label
                                                for="checkbox_is_remote" class="custom-control-label">
                                                Remote
                                            </label></div>
                                        <div class="p-1" style="min-width: 80px;">Timezone:</div> <select
                                            name="remote_timezone_id" class="custom-select custom-select-sm"
                                            id="__BVID__30">
                                            <option value="0">Any</option>
                                            <option value="1">Africa/Abidjan</option>
                                            
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="pl-4 ml-1 custom-control custom-checkbox"><input v-model="formData.workPreference"
                                                id="checkbox_is_physical" type="checkbox" name="checkbox_is_physical"
                                                aria-required="true" class="custom-control-input" value="onsite"><label
                                                for="checkbox_is_physical" class="custom-control-label">
                                                On Site
                                            </label></div>
                                        <div class="p-1" style="min-width: 80px;">Country:</div> <select
                                            name="physical_country_id" class="custom-select custom-select-sm"
                                            id="__BVID__32">
                                            <option value="1">Afghanistan</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="row w-100">
                                    <div class="col-md">
                                        <div id="location-remote-checkbox-form-group" role="group" class="form-group">
                                            <!---->
                                            <div class="bv-no-focus-ring">
                                                <!---->
                                                <div tabindex="-1" role="alert" aria-live="assertive" aria-atomic="true"
                                                    class="invalid-feedback">Please select at least one type of
                                                    location.</div>
                                                <!---->
                                                <!---->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row profile-row">
                            <div class="col-md-2 fw-form-label flex-wrap align-content-center">
                                Experience
                            </div>
                            <div class="col-md-10 d-flex flex-wrap align-content-center">
                                <div class="row w-100">
                                    <div class="col-md"><select name="experience"
                                            class="w-25 custom-select custom-select-sm" id="__BVID__34">
                                           
                                            <option value="50">50+ years</option>
                                        </select></div>
                                </div>
                            </div>
                        </div>
                        <div class="row profile-row">
                            <div class="col-md-2 fw-form-label flex-wrap align-content-center">
                                Available for Work
                            </div>
                            <div class="col-md-10 d-flex flex-wrap align-content-center">
                                <div class="row w-100">
                                    <div class="col-md">
                                        <div class="pl-4 ml-1 custom-control custom-checkbox"><input id="is_available"
                                                type="checkbox" name="is_available" aria-required="true"
                                                class="custom-control-input" value="true"><label for="is_available"
                                                class="custom-control-label"></label></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row profile-row">
                            <div class="col-md-2 fw-form-label flex-wrap align-content-center">
                                Compensation
                            </div>
                            <div class="col-md-10 d-flex flex-wrap align-content-center">
                                <div class="row w-100">
                                    <div class="col-md"><select name="compensation"
                                            class="w-25 custom-select custom-select-sm" id="__BVID__36">
                                            <option value="0">$0K+ / year</option>
                                           
                                            <option value="500">$500K+ / year</option>
                                        </select></div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="mt-5 text-right">
                        <button class="btn btn-primary profile-button" type="submit">
                            Save Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useVuelidate } from '@vuelidate/core'
import { required, minLength, helpers } from "@vuelidate/validators"
import axios from 'axios'

const files = ref([]);
const myImage = ref(null)
const previewImage = ref('')
const status = ref(false)
const userBasedSkillList = ref([])


const containsUser = (value) => {
    //  return value.includes("user")
}

const mustIncludeOne = () => {
    if (formData.numberOfDays.length > 0) {
        return true;
    }
}

const days = ref([
    {
        id: 1,
        name: 'Monday'
    },
    {
        id: 2,
        name: 'Tuesday'
    },
]);

const formData = ref({
    firstname: '',
    lastname: '',
    about: '',
    numberOfDays: [],
    workType: [],
    workPreference: [],
    skills: ['1','2','5']
})
const onlyString = () => {

}
const rules = {
    firstname: {
        required
        //required:helpers.regex(/^([^0-9]*)$/)
        // minLength: minLength(10),
        // containsUser: helpers.withMessage("the field must contain firstname",
        // containsUser
        //, ),
    },
    lastname: {
        required
    },
    about: {
        required,
        minLength: minLength(2)
    },
    numberOfDays: {
        required: helpers.withMessage('Your availability must be atleast one day', required),
        // minLength: minLength(2), //min lenght is fine, can remove mustIncludeOne
        // mustIncludeOne
    },
    workType: {
        required: helpers.withMessage('Please select at least one work type', required),
    }
}
const v$ = useVuelidate(rules, formData);

const formOnSubmit = async () => {

    const result = await v$.value.$validate();
    if (result) {
        alert('success')
        axios.post('/user/profile', { formData: formData.value }).then((response) => {
            console.log(response.data)
        }).catch((error) => {
            console.log(error)
        })
    } else {
        const el = document.getElementById('firstname')
        el.scrollIntoView({ behavior: 'smooth' });
        alert('error')
    }
}

onMounted(() => {
    axios.get('/userbased-skills').then((response) => {
        userBasedSkillList.value = response.data
    }).catch((error) => {
        alert('error in fetching skills')
    })
})

const updateProfilePicture = (e) => {
    status.value = true
    const image = myImage.value.files[0];
    const reader = new FileReader();
    reader.readAsDataURL(image);
    reader.onload = e => {
        previewImage.value = e.target.result;
        console.log(previewImage.value);
    };
    //  status.value = false
}
</script>
<style scoped>
.error-red {
    color: red;
}

.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 2px solid blue;
  border-right: 2px solid green;
  border-bottom: 2px solid red;
  border-left: 2px solid pink;
  width: 30px;
  height: 30px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

</style>