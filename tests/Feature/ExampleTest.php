<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Job;
use App\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_home_page_displays_featured_jobs(): void
    {
        Job::factory(8)->create();

        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertSee('Jëf & Yoon');
    }

    public function test_job_listing_page_displays_jobs(): void
    {
        Job::factory(3)->create();

        $response = $this->get('/emplois');

        $response->assertStatus(200)
            ->assertSee('Offres d');
    }

    public function test_job_detail_page_returns_200(): void
    {
        $job = Job::factory()->create();

        $response = $this->get("/emplois/{$job->slug}");

        $response->assertStatus(200)
            ->assertSee($job->title);
    }

    public function test_login_page_returns_200(): void
    {
        $response = $this->get('/connexion');

        $response->assertStatus(200);
    }

    public function test_register_page_returns_200(): void
    {
        $response = $this->get('/inscription');

        $response->assertStatus(200);
    }

    public function test_candidate_registration_and_login(): void
    {
        $response = $this->post('/inscription', [
            'name' => 'Test Candidat',
            'email' => 'test.candidat@example.com',
            'role' => 'candidate',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('candidate.profile'));

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'test.candidat@example.com',
            'role' => 'candidate',
        ]);
    }

    public function test_company_registration(): void
    {
        $response = $this->post('/inscription', [
            'name' => 'Test Entreprise SARL',
            'email' => 'test.company@example.com',
            'role' => 'company',
            'location' => 'Dakar',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('company.dashboard'));

        $this->assertAuthenticated();
        $this->assertDatabaseHas('companies', [
            'name' => 'Test Entreprise SARL',
        ]);
    }

    public function test_login_with_valid_credentials(): void
    {
        $user = User::factory()->candidate()->create([
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/connexion', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('candidate.dashboard'));
        $this->assertAuthenticated();
    }

    public function test_login_with_invalid_credentials(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/connexion', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_candidate_dashboard_requires_auth(): void
    {
        $response = $this->get('/candidat/tableau-de-bord');

        $response->assertRedirect('/connexion');
    }

    public function test_company_dashboard_requires_company_role(): void
    {
        $user = User::factory()->candidate()->create();

        $response = $this->actingAs($user)->get('/entreprise/tableau-de-bord');

        $response->assertRedirect(route('candidate.dashboard'));
    }

    public function test_company_can_publish_job(): void
    {
        $user = User::factory()->company()->create();
        Company::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post('/entreprise/offres', [
            'title' => 'Développeur Laravel',
            'location' => 'Dakar',
            'contract_type' => 'CDI',
            'experience_level' => '3-5 ans',
            'salary_min' => 300000,
            'salary_max' => 500000,
            'skills_required' => ['PHP', 'Laravel'],
            'description' => 'Nous recherchons un développeur Laravel passionné pour rejoindre notre équipe technique. Vous serez en charge du développement d\'applications métier robustes avec Laravel et Vue.js dans un environnement collaboratif et innovant basé à Dakar.',
            'skills_input' => 'Vue.js',
        ]);

        $response->assertRedirect(route('company.dashboard'));
        $this->assertDatabaseHas('job_listings', [
            'title' => 'Développeur Laravel',
            'location' => 'Dakar',
        ]);
    }

    public function test_job_search_with_filters(): void
    {
        Job::factory()->create([
            'title' => 'Développeur PHP',
            'location' => 'Dakar',
            'contract_type' => 'CDI',
            'experience_level' => '3-5 ans',
        ]);

        Job::factory()->create([
            'title' => 'Designer UI',
            'location' => 'Pikine',
            'contract_type' => 'CDD',
            'experience_level' => '1-2 ans',
        ]);

        $response = $this->get('/emplois?keyword=développeur&location=Dakar');

        $response->assertStatus(200)
            ->assertSee('Développeur PHP')
            ->assertSee('Dakar');
    }
}
