var PeriodicalExecuter = Class.create({
    initialize: function(callback, frequency) {
        this.callback = callback;
        this.frequency = frequency;
        this.currentlyExecuting = false;
        this.lastExec = this.now();
        this.paused = false;
        this.pausedAt = 0;
        this.accumTimePaused = 0;
        this.registerCallback();
    },

    registerCallback: function() {
        this.timer = setInterval(this.onTimerEvent.bind(this),
            this.frequency * 1000);
    },

    execute: function() {
        this.callback(this);
    },

    pause: function(){
        if (this.paused) return;
        this.stop();
        this.paused = true;
        this.pausedAt = this.now();
        return true;
    },

    timeLeft: function(){
        if(this.paused){
            return this.frequency - (this.pausedAt - this.accumTimePaused -
                this.lastExec);
        }else if(this.timer==null){
            return null;
        }else{
            return this.frequency - (this.now() - this.accumTimePaused -
                this.lastExec);
        }
    },

    restart: function(){
        if (this.paused){
            if(this.resheduledJob>0){clearTimeout(this.resheduledJob)}
            this.resheduledJob = setTimeout(this.reJobCallback.bind(this),
                this.timeLeft()*1000);
            this.accumTimePaused += this.now() - this.pausedAt;
        }else if(this.timer == null){
            this.registerCallback();
        }
        this.pausedAt = null;
        this.paused = false;
    },

    reJobCallback : function(){
        this.onTimerEvent();
        this.registerCallback();
        this.accumTimePaused = 0;
    },

    now: function(){ return new Date().getTime() / 1000;},

    stop: function() {
        if (!this.timer) return;
        clearInterval(this.timer);
        this.timer = null;
    },

    onTimerEvent: function() {
        if (!this.currentlyExecuting) {
            try {
                this.currentlyExecuting = true;
                this.execute();
            } finally {
                this.currentlyExecuting = false;
                this.lastExec = this.now();
            }
        }
    }
});