<?php

namespace App\Policies;

use App\User;
use App\AcademicDegree;
use Illuminate\Auth\Access\HandlesAuthorization;

class AcademicDegreePolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any academic degrees.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the academic degree.
     *
     * @param  \App\User  $user
     * @param  \App\AcademicDegree  $academicDegree
     * @return mixed
     */
    public function view(User $user, AcademicDegree $academicDegree)
    {
        //
    }

    /**
     * Determine whether the user can create academic degrees.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the academic degree.
     *
     * @param  \App\User  $user
     * @param  \App\AcademicDegree  $academicDegree
     * @return mixed
     */
    public function update(User $user, AcademicDegree $academicDegree)
    {
        return $academicDegree->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the academic degree.
     *
     * @param  \App\User  $user
     * @param  \App\AcademicDegree  $academicDegree
     * @return mixed
     */
    public function delete(User $user, AcademicDegree $academicDegree)
    {
        return $academicDegree->user_id == $user->id;
    }

    /**
     * Determine whether the user can restore the academic degree.
     *
     * @param  \App\User  $user
     * @param  \App\AcademicDegree  $academicDegree
     * @return mixed
     */
    public function restore(User $user, AcademicDegree $academicDegree)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the academic degree.
     *
     * @param  \App\User  $user
     * @param  \App\AcademicDegree  $academicDegree
     * @return mixed
     */
    public function forceDelete(User $user, AcademicDegree $academicDegree)
    {
        //
    }
}
