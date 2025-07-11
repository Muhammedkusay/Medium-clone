@props(['user'])

<div x-data="{ 
    following: {{ auth()->user() && $user->isFollowedBy(auth()->user()) ? 'true' : 'false' }},
    followersCount: {{ $user->followers->count() }},
    follow() {
        this.following = !this.following
        axios.post('/follow/{{$user->id}}')
            .then((res) => {
                this.followersCount = res.data.followersCount
            })
            .catch(err => console.log(err))
    },
}">
    {{$slot}}
</div>