<?php

namespace Database\Seeders;

use App\Models\Specialism;
use Illuminate\Database\Seeder;

class SpecialismSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Specialism::factory(['name' => 'Abuse / Physical', 'Specialism_category_id' => 1])->create();
        Specialism::factory(['name' => 'Abuse / Emotional', 'Specialism_category_id' => 1])->create();
        Specialism::factory(['name' => 'Abuse / Sexual', 'Specialism_category_id' => 1])->create();

        Specialism::factory(['name' => 'Addiction / Alcohol', 'Specialism_category_id' => 2])->create();
        Specialism::factory(['name' => 'Addiction / Caffeine', 'Specialism_category_id' => 2])->create();
        Specialism::factory(['name' => 'Addiction / Cannabis', 'Specialism_category_id' => 2])->create();
        Specialism::factory(['name' => 'Addiction / Cocaine', 'Specialism_category_id' => 2])->create();
        Specialism::factory(['name' => 'Addiction / Drug', 'Specialism_category_id' => 2])->create();
        Specialism::factory(['name' => 'Addiction / Gambling', 'Specialism_category_id' => 2])->create();
        Specialism::factory(['name' => 'Addiction / Inhalant', 'Specialism_category_id' => 2])->create();
        Specialism::factory(['name' => 'Addiction / Internet', 'Specialism_category_id' => 2])->create();
        Specialism::factory(['name' => 'Addiction / Hallucinogen', 'Specialism_category_id' => 2])->create();
        Specialism::factory(['name' => 'Addiction / Love and romance', 'Specialism_category_id' => 2])->create();
        Specialism::factory(['name' => 'Addiction / Opioid', 'Specialism_category_id' => 2])->create();
        Specialism::factory(['name' => 'Addiction / Other substance', 'Specialism_category_id' => 2])->create();
        Specialism::factory(['name' => 'Addiction / Pornography', 'Specialism_category_id' => 2])->create();
        Specialism::factory(['name' => 'Addiction / Prescription medication', 'Specialism_category_id' => 2])->create();
        Specialism::factory(['name' => 'Addiction / Sex', 'specialism_category_id' => 2])->create();
        Specialism::factory(['name' => 'Addiction / Smoking', 'Specialism_category_id' => 2])->create();
        Specialism::factory(['name' => 'Addiction / Social media', 'Specialism_category_id' => 2])->create();
        Specialism::factory(['name' => 'Addiction / Stimulant', 'Specialism_category_id' => 2])->create();
        Specialism::factory(['name' => 'Addiction / Video game', 'Specialism_category_id' => 2])->create();
        Specialism::factory(['name' => 'Addiction / Chemsex', 'Specialism_category_id' => 2])->create();


        Specialism::factory(['name' => 'Anger / Aggression', 'Specialism_category_id' => 3])->create();
        Specialism::factory(['name' => 'Anger / Anger management', 'Specialism_category_id' => 3])->create();
        Specialism::factory(['name' => 'Anger / Passive aggressive behaviour', 'Specialism_category_id' => 3])->create();

        Specialism::factory(['name' => 'Anxiety / Agoraphobia', 'Specialism_category_id' => 4])->create();
        Specialism::factory(['name' => 'Anxiety / Acute stress', 'Specialism_category_id' => 4])->create();
        Specialism::factory(['name' => 'Anxiety / Death', 'Specialism_category_id' => 4])->create();
        Specialism::factory(['name' => 'Anxiety / Financial', 'Specialism_category_id' => 4])->create();
        Specialism::factory(['name' => 'Anxiety / Generalised', 'Specialism_category_id' => 4])->create();
        Specialism::factory(['name' => 'Anxiety / Health', 'Specialism_category_id' => 4])->create();
        Specialism::factory(['name' => 'Anxiety / Panic attacks', 'Specialism_category_id' => 4])->create();
        Specialism::factory(['name' => 'Anxiety / Performance', 'Specialism_category_id' => 4])->create();
        Specialism::factory(['name' => 'Anxiety / Separation', 'Specialism_category_id' => 4])->create();
        Specialism::factory(['name' => 'Anxiety / Social anxiety disorder', 'Specialism_category_id' => 4])->create();
        Specialism::factory(['name' => 'Anxiety / Social phobia', 'Specialism_category_id' => 4])->create();
        Specialism::factory(['name' => 'Anxiety / Specific phobia', 'Specialism_category_id' => 4])->create();
        Specialism::factory(['name' => 'Anxiety / Stress management', 'Specialism_category_id' => 4])->create();

        Specialism::factory(['name' => 'Conduct disorders / Antisocial personality disorder', 'Specialism_category_id' => 5])->create();
        Specialism::factory(['name' => 'Conduct disorders / Intermittent explosive disorder', 'Specialism_category_id' => 5])->create();
        Specialism::factory(['name' => 'Conduct disorders / Kleptomania', 'Specialism_category_id' => 5])->create();
        Specialism::factory(['name' => 'Conduct disorders / Opposition defiance', 'Specialism_category_id' => 5])->create();
        Specialism::factory(['name' => 'Conduct disorders / Pyromania', 'Specialism_category_id' => 5])->create();

        Specialism::factory(['name' => 'Depression / Dysthymia', 'Specialism_category_id' => 6])->create();
        Specialism::factory(['name' => 'Depression / Major', 'Specialism_category_id' => 6])->create();
        Specialism::factory(['name' => 'Premenstrual syndrome (PMS)', 'Specialism_category_id' => 6])->create();
        Specialism::factory(['name' => 'Pre and post-natal depression', 'Specialism_category_id' => 6])->create();
        Specialism::factory(['name' => 'Depression / Seasonal affective', 'Specialism_category_id' => 6])->create();
        Specialism::factory(['name' => 'Depression / Self harm', 'Specialism_category_id' => 6])->create();
        Specialism::factory(['name' => 'Depression / Suicidal thoughts', 'Specialism_category_id' => 6])->create();

        Specialism::factory(['name' => 'Developmental disorders / Adhd', 'Specialism_category_id' => 7])->create();
        Specialism::factory(['name' => 'Developmental disorders / Autistic', 'Specialism_category_id' => 7])->create();
        Specialism::factory(['name' => 'Developmental disorders / Learning disorder', 'Specialism_category_id' => 7])->create();

        Specialism::factory(['name' => 'Dissociative disorders / Depersonalisation', 'Specialism_category_id' => 8])->create();
        Specialism::factory(['name' => 'Dissociative disorders / Dissociative identity disorder', 'Specialism_category_id' => 8])->create();

        Specialism::factory(['name' => 'Eating / Anorexia', 'Specialism_category_id' => 9])->create();
        Specialism::factory(['name' => 'Eating / Binge and over eating', 'Specialism_category_id' => 9])->create();
        Specialism::factory(['name' => 'Eating / Bulimia', 'Specialism_category_id' => 9])->create();
        Specialism::factory(['name' => 'Eating / Night eating', 'Specialism_category_id' => 9])->create();
        Specialism::factory(['name' => 'Eating / Obesity', 'Specialism_category_id' => 9])->create();
        Specialism::factory(['name' => 'Eating / Pica', 'Specialism_category_id' => 9])->create();
        Specialism::factory(['name' => 'Eating / Purging', 'Specialism_category_id' => 9])->create();
        Specialism::factory(['name' => 'Eating / Restrictive food intake', 'Specialism_category_id' => 9])->create();
        Specialism::factory(['name' => 'Eating / Rumination', 'Specialism_category_id' => 9])->create();
        Specialism::factory(['name' => 'Eating / Weight management', 'Specialism_category_id' => 9])->create();

        Specialism::factory(['name' => 'Education / Boarding school concerns', 'Specialism_category_id' => 10])->create();
        Specialism::factory(['name' => 'Education / Dyslexia', 'Specialism_category_id' => 10])->create();
        Specialism::factory(['name' => 'Education / Exam pressure', 'Specialism_category_id' => 10])->create();
        Specialism::factory(['name' => 'Education / Learning difficulties', 'Specialism_category_id' => 10])->create();
        Specialism::factory(['name' => 'School/academic performance', 'Specialism_category_id' => 10])->create();

        Specialism::factory(['name' => 'Family / Adoption', 'Specialism_category_id' => 11])->create();
        Specialism::factory(['name' => 'Family / Blended famil', 'Specialism_category_id' => 11])->create();
        Specialism::factory(['name' => 'Family / Carer support', 'Specialism_category_id' => 11])->create();
        Specialism::factory(['name' => 'Family / Conflict', 'Specialism_category_id' => 11])->create();

        Specialism::factory(['name' => 'Grief / Anticipatory mourning', 'Specialism_category_id' => 12])->create();
        Specialism::factory(['name' => 'Grief / Bereavement', 'Specialism_category_id' => 12])->create();
        Specialism::factory(['name' => 'Grief / Complicated grief', 'Specialism_category_id' => 12])->create();
        Specialism::factory(['name' => 'Grief / Loss of a pet', 'Specialism_category_id' => 12])->create();
        Specialism::factory(['name' => 'Grief / Loss of a parent', 'Specialism_category_id' => 12])->create();
        Specialism::factory(['name' => 'Grief / Loss of a spouse', 'Specialism_category_id' => 12])->create();
        Specialism::factory(['name' => 'Grief / Loss of a child', 'Specialism_category_id' => 12])->create();
        Specialism::factory(['name' => 'Grief / Sudden loss', 'Specialism_category_id' => 12])->create();
        Specialism::factory(['name' => 'Unemployment / redundancy', 'Specialism_category_id' => 12])->create();

        Specialism::factory(['name' => 'Health / Abortion', 'Specialism_category_id' => 13])->create();
        Specialism::factory(['name' => 'Health / Alzheimers', 'Specialism_category_id' => 13])->create();
        Specialism::factory(['name' => 'Health / Brain injury', 'Specialism_category_id' => 13])->create();
        Specialism::factory(['name' => 'Health / Cancer', 'Specialism_category_id' => 13])->create();
        Specialism::factory(['name' => 'Chronic fatigue syndrome / ME', 'Specialism_category_id' => 13])->create();
        Specialism::factory(['name' => 'Health / Chronic illness', 'Specialism_category_id' => 13])->create();
        Specialism::factory(['name' => 'Health / Dementia', 'Specialism_category_id' => 13])->create();
        Specialism::factory(['name' => 'Health / Disability', 'Specialism_category_id' => 13])->create();
        Specialism::factory(['name' => 'Health / Dyspraxia', 'Specialism_category_id' => 13])->create();
        Specialism::factory(['name' => 'HIV / Aids', 'Specialism_category_id' => 13])->create();
        Specialism::factory(['name' => 'Fertility / infertility', 'Specialism_category_id' => 13])->create();
        Specialism::factory(['name' => 'Health / Miscarriage', 'Specialism_category_id' => 13])->create();
        Specialism::factory(['name' => 'Health / Pain management', 'Specialism_category_id' => 13])->create();
        Specialism::factory(['name' => 'Health / Pregnancy and birth', 'Specialism_category_id' => 13])->create();
        Specialism::factory(['name' => 'Health / Psychosomatic', 'Specialism_category_id' => 13])->create();
        Specialism::factory(['name' => 'Health / Restless leg syndrome', 'Specialism_category_id' => 13])->create();
        Specialism::factory(['name' => 'Health / Stillbirth', 'Specialism_category_id' => 13])->create();
        Specialism::factory(['name' => 'Health / Terminal illness', 'Specialism_category_id' => 13])->create();
        Specialism::factory(['name' => 'Health / Tourettes', 'Specialism_category_id' => 13])->create();
        Specialism::factory(['name' => 'Health / Vaginismus', 'Specialism_category_id' => 13])->create();

        Specialism::factory(['name' => 'Cultural / religious identity', 'Specialism_category_id' => 14])->create();
        Specialism::factory(['name' => 'Identity / Discrimination', 'Specialism_category_id' => 14])->create();
        Specialism::factory(['name' => 'Identity / Gender identity', 'Specialism_category_id' => 14])->create();
        Specialism::factory(['name' => 'Identity / Identity crisis', 'Specialism_category_id' => 14])->create();
        Specialism::factory(['name' => 'LGBTQ', 'Specialism_category_id' => 14])->create();
        Specialism::factory(['name' => 'Men\' issues', 'Specialism_category_id' => 14])->create();
        Specialism::factory(['name' => 'Identity / Racial identity', 'Specialism_category_id' => 14])->create();
        Specialism::factory(['name' => 'Identity / Sexual orientation', 'Specialism_category_id' => 14])->create();
        Specialism::factory(['name' => 'Women\' issues', 'Specialism_category_id' => 14])->create();

        Specialism::factory(['name' => 'Mood / Bipolar disorder', 'Specialism_category_id' => 15])->create();
        Specialism::factory(['name' => 'Mood / Cyclothymia', 'Specialism_category_id' => 15])->create();
        Specialism::factory(['name' => 'Mood / Disruptive mood dysregulation', 'Specialism_category_id' => 15])->create();
        Specialism::factory(['name' => 'Mood / Hypomania', 'Specialism_category_id' => 15])->create();

        Specialism::factory(['name' => 'Body dysmorphia (BDD)', 'Specialism_category_id' => 16])->create();
        Specialism::factory(['name' => 'Ocd / Excoriation', 'Specialism_category_id' => 16])->create();
        Specialism::factory(['name' => 'Ocd / Hoarding', 'Specialism_category_id' => 16])->create();
        Specialism::factory(['name' => 'Obsessive compulsive disorder (OCD)', 'Specialism_category_id' => 16])->create();
        Specialism::factory(['name' => 'Ocd / Trichotillomania', 'Specialism_category_id' => 16])->create();
        Specialism::factory(['name' => 'Obsessive Compulsive Personality Disorder (OCPD)', 'Specialism_category_id' => 16])->create();

        Specialism::factory(['name' => 'Personal / Bitterness', 'Specialism_category_id' => 17])->create();
        Specialism::factory(['name' => 'Personal / Boundary setting', 'Specialism_category_id' => 17])->create();
        Specialism::factory(['name' => 'Personal / Childhood related', 'Specialism_category_id' => 17])->create();
        Specialism::factory(['name' => 'Personal / Confidence', 'Specialism_category_id' => 17])->create();
        Specialism::factory(['name' => 'Personal / Feeling lost', 'Specialism_category_id' => 17])->create();
        Specialism::factory(['name' => 'Personal / Goal setting', 'Specialism_category_id' => 17])->create();
        Specialism::factory(['name' => 'Personal / Guilt', 'Specialism_category_id' => 17])->create();
        Specialism::factory(['name' => 'Personal / Jealousy', 'Specialism_category_id' => 17])->create();
        Specialism::factory(['name' => 'Personal / Lack of focus', 'Specialism_category_id' => 17])->create();
        Specialism::factory(['name' => 'Personal / Life transition', 'Specialism_category_id' => 17])->create();
        Specialism::factory(['name' => 'Personal / Life coaching', 'Specialism_category_id' => 17])->create();
        Specialism::factory(['name' => 'Personal / Manipulative behaviour', 'Specialism_category_id' => 17])->create();
        Specialism::factory(['name' => 'Personal / Mid life crisis', 'Specialism_category_id' => 17])->create();
        Specialism::factory(['name' => 'Personal / Motivation', 'Specialism_category_id' => 17])->create();
        Specialism::factory(['name' => 'Personal / Nervous breakdown', 'Specialism_category_id' => 17])->create();
        Specialism::factory(['name' => 'Personal / Personal development', 'Specialism_category_id' => 17])->create();
        Specialism::factory(['name' => 'Personal / Self esteem', 'Specialism_category_id' => 17])->create();
        Specialism::factory(['name' => 'Personal / Shyness', 'Specialism_category_id' => 17])->create();
        Specialism::factory(['name' => 'Personal / Spirituality', 'Specialism_category_id' => 17])->create();
        Specialism::factory(['name' => 'Personal / Sports performance', 'Specialism_category_id' => 17])->create();
        Specialism::factory(['name' => 'Personal / Victim mentality', 'Specialism_category_id' => 17])->create();

        Specialism::factory(['name' => 'Personality disorders / Avoidant', 'Specialism_category_id' => 18])->create();
        Specialism::factory(['name' => 'Personality disorders / Borderline', 'Specialism_category_id' => 18])->create();
        Specialism::factory(['name' => 'Personality disorders / Dependent', 'Specialism_category_id' => 18])->create();
        Specialism::factory(['name' => 'Personality disorders / Histrionic', 'Specialism_category_id' => 18])->create();
        Specialism::factory(['name' => 'Personality disorders / Narcissistic', 'Specialism_category_id' => 18])->create();
        Specialism::factory(['name' => 'Personality disorders / Paranoid', 'Specialism_category_id' => 18])->create();
        Specialism::factory(['name' => 'Personality disorders / Schizoid', 'Specialism_category_id' => 18])->create();
        Specialism::factory(['name' => 'Alexithymia', 'Specialism_category_id' => 18])->create();

        Specialism::factory(['name' => 'Relationships / Abandonment', 'Specialism_category_id' => 19])->create();
        Specialism::factory(['name' => 'Affairs / infidelity', 'Specialism_category_id' => 19])->create();
        Specialism::factory(['name' => 'Relationships / Attachment issues', 'Specialism_category_id' => 19])->create();
        Specialism::factory(['name' => 'Breakups, divorce and separation', 'Specialism_category_id' => 19])->create();
        Specialism::factory(['name' => 'Relationships / Codependency', 'Specialism_category_id' => 19])->create();
        Specialism::factory(['name' => 'Relationships / Communication difficulties', 'Specialism_category_id' => 19])->create();
        Specialism::factory(['name' => 'Relationships / Cross cultural', 'Specialism_category_id' => 19])->create();
        Specialism::factory(['name' => 'Relationships / Doubt in relationships', 'Specialism_category_id' => 19])->create();
        Specialism::factory(['name' => 'Relationships / Intimacy', 'Specialism_category_id' => 19])->create();
        Specialism::factory(['name' => 'Relationships / Marriage problems', 'Specialism_category_id' => 19])->create();
        Specialism::factory(['name' => 'Relationships / Parenting related', 'Specialism_category_id' => 19])->create();
        Specialism::factory(['name' => 'Relationships / Peer relationships', 'Specialism_category_id' => 19])->create();
        Specialism::factory(['name' => 'Relationships / Premarital counselling', 'Specialism_category_id' => 19])->create();
        Specialism::factory(['name' => 'Relationships / Rejection', 'Specialism_category_id' => 19])->create();
        Specialism::factory(['name' => 'Relationships / Same sex couple issues', 'Specialism_category_id' => 19])->create();

        Specialism::factory(['name' => 'Schizophrenia / Brief psychosis', 'Specialism_category_id' => 20])->create();
        Specialism::factory(['name' => 'Schizophrenia / Delusions', 'Specialism_category_id' => 20])->create();
        Specialism::factory(['name' => 'Schizophrenia / Hallucinations', 'Specialism_category_id' => 20])->create();
        Specialism::factory(['name' => 'Schizophrenia / Psychosis', 'Specialism_category_id' => 20])->create();
        Specialism::factory(['name' => 'Schizophrenia / Schizophrenia', 'Specialism_category_id' => 20])->create();
        Specialism::factory(['name' => 'Schizophrenia / Schizotypal personality disorder', 'Specialism_category_id' => 20])->create();
        Specialism::factory(['name' => 'Schizophrenia / Substance induced psychosis', 'Specialism_category_id' => 20])->create();

        Specialism::factory(['name' => 'Sexual difficulties / Erectile dysfunction', 'Specialism_category_id' => 21])->create();
        Specialism::factory(['name' => 'Sexual difficulties / Dyspareunia', 'Specialism_category_id' => 21])->create();
        Specialism::factory(['name' => 'Sexual difficulties / Hypoactive desire', 'Specialism_category_id' => 21])->create();
        Specialism::factory(['name' => 'Sexual difficulties / Orgasmic disorders', 'Specialism_category_id' => 21])->create();
        Specialism::factory(['name' => 'Premature &amp; delayed ejaculation', 'Specialism_category_id' => 21])->create();
        Specialism::factory(['name' => 'Sexual difficulties / Sexual arousal difficulties', 'Specialism_category_id' => 21])->create();
        Specialism::factory(['name' => 'Sexual difficulties / Sexual aversion', 'Specialism_category_id' => 21])->create();

        Specialism::factory(['name' => 'Paraphilias / Exhibitionism', 'Specialism_category_id' => 22])->create();
        Specialism::factory(['name' => 'Paraphilias / Fetishism', 'Specialism_category_id' => 22])->create();
        Specialism::factory(['name' => 'Paraphilias / Frotteurism', 'Specialism_category_id' => 22])->create();
        Specialism::factory(['name' => 'Paraphilias / Paedophilia<', 'Specialism_category_id' => 22])->create();
        Specialism::factory(['name' => 'Sadism / masochism', 'Specialism_category_id' => 22])->create();
        Specialism::factory(['name' => 'Paraphilias / Transvestism', 'Specialism_category_id' => 22])->create();
        Specialism::factory(['name' => 'Paraphilias / Voyeurism', 'Specialism_category_id' => 22])->create();

        Specialism::factory(['name' => 'Sleep concerns / Disturbed sleep', 'Specialism_category_id' => 23])->create();
        Specialism::factory(['name' => 'Sleep concerns / Excessive sleep', 'Specialism_category_id' => 23])->create();
        Specialism::factory(['name' => 'Sleep concerns / Hypersomnolence', 'Specialism_category_id' => 23])->create();
        Specialism::factory(['name' => 'Sleep concerns / Insomnia', 'Specialism_category_id' => 23])->create();
        Specialism::factory(['name' => 'Sleep concerns / Narcolepsy', 'Specialism_category_id' => 23])->create();
        Specialism::factory(['name' => 'Sleep concerns / Sleepwalking', 'Specialism_category_id' => 23])->create();
        Specialism::factory(['name' => 'Sleep concerns / Sleep terrors', 'Specialism_category_id' => 23])->create();

        Specialism::factory(['name' => 'Somatic / Conversion disorder', 'Specialism_category_id' => 24])->create();
        Specialism::factory(['name' => 'Somatic / Factitious disorder', 'Specialism_category_id' => 24])->create();
        Specialism::factory(['name' => 'Somatic / Hypochondriasis', 'Specialism_category_id' => 24])->create();
        Specialism::factory(['name' => 'Somatic / Pain disorder', 'Specialism_category_id' => 24])->create();
        Specialism::factory(['name' => 'Somatic / Somatic symptom disorder', 'Specialism_category_id' => 24])->create();

        Specialism::factory(['name' => 'Trauma / Adjustment disorder', 'Specialism_category_id' => 25])->create();
        Specialism::factory(['name' => 'Trauma / Post traumatic stress disorder', 'Specialism_category_id' => 25])->create();

        Specialism::factory(['name' => 'Work / Career progress', 'Specialism_category_id' => 2])->create();
        Specialism::factory(['name' => 'Work / Leadership', 'Specialism_category_id' => 26])->create();
        Specialism::factory(['name' => 'Work / Mediation', 'Specialism_category_id' => 26])->create();
        Specialism::factory(['name' => 'Work / Workplace bullying', 'Specialism_category_id' => 26])->create();
        Specialism::factory(['name' => 'Work / Workplace stress', 'Specialism_category_id' => 26])->create();
        Specialism::factory(['name' => 'Work / Workplace performance', 'Specialism_category_id' => 26])->create();
    }
}
